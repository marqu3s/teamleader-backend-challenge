<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 21:24
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\discounts;

use api\models\Customer;
use api\models\Order;
use api\models\Product;

/**
 * Interface IDiscount
 * All discounts directly modify the Order object.
 *
 * @package api\discounts
 */
interface IDiscount
{
    /**
     * This must be called to evaluate the order and apply the discount.
     *
     * @var Order $order
     * @var Customer $customer
     * @var Product[]|null $products Models of products in the order.
     */
    public function apply(&$order, $customer, $products = null);
}
