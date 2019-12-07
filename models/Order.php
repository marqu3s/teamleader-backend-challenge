<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 19:35
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\models;

use api\discounts\GoldClientDiscount;
use api\discounts\IDiscount;
use api\discounts\SwitchesDiscount;
use api\discounts\ToolsDiscount;
use api\services\CustomerService;
use api\services\ProductService;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * Class Order
 * Order model. This model represents an order sent with the request.
 *
 * @package api\models
 */
class Order extends Model
{
    /** @var integer $id */
    public $id;

    /** @var integer $customer_id */
    public $customer_id;

    /** @var OrderItem[] $items */
    public $items;

    /** @var float $total */
    public $total;

    /** @var float $total - Hold the total value before applying any discount. */
    public $total_before_discount;

    /** @var array $discounts */
    public $discounts_descriptions = [];

    /**
     * This is where the active discounts are defined.
     * To apply a new discount, create a new discount class
     * in the "discounts" folder and add it to the array bellow.
     * They will be applied following the order bellow.
     */
    private $activeDiscounts = [
        GoldClientDiscount::class,
        SwitchesDiscount::class,
        ToolsDiscount::class,
    ];

    /**
     * Executed everytime a model is created.
     * It is being used to convert the order items to objects.
     */
    public function init()
    {
        parent::init();

        foreach ($this->items as $i => $orderItem) {
            $this->items[$i] = new OrderItem($orderItem);
        }

        $this->total_before_discount = $this->total;
    }

    /**
     * Process the order and apply the applicable discounts.
     *
     * @throws NotFoundHttpException
     */
    public function applyDiscounts()
    {
        $customer = $this->getCustomer();
        $products = $this->getProducts();

        // Loop the activeDiscounts array to apply the discounts.
        foreach ($this->activeDiscounts as $discountClassname) {
            /** @var IDiscount $discount */
            $discount = new $discountClassname;
            $discount->apply($this, $customer, $products);
        }

        // Round total to avoid more than 2 decimal places.
        $this->total = round($this->total, 2);
    }

    /**
     * Returns the customer associated with this order.
     * It consumes the Customer service.
     *
     * @return Customer
     * @throws NotFoundHttpException
     */
    public function getCustomer()
    {
        $serviceResponse = CustomerService::getCustomer($this->customer_id);

        return new Customer($serviceResponse);
    }

    /**
     * Returns the products associated with this order.
     * It consumes the Product service.
     *
     * @return Product[]
     * @throws NotFoundHttpException
     * @todo Avoid many calls to the service. Implement a cache maybe?
     */
    public function getProducts()
    {
        $products = [];
        foreach ($this->items as $orderItem) {
            $serviceResponse = ProductService::getProduct($orderItem->product_id);
            $products[$orderItem->product_id] = new Product($serviceResponse);
        }

        return $products;
    }
}
