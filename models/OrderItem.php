<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 22:04
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\models;

use yii\base\Model;

/**
 * Class OrderItem
 * OrderItem model. This model represents an order item.
 *
 * @package api\models
 */
class OrderItem extends Model
{
    /** @var string $product_id */
    public $product_id;

    /** @var integer $quantity */
    public $quantity;

    /** @var float $unit_price */
    public $unit_price;

    /** @var float $total */
    public $total;

    /** @var float $total - Holds the total value before applying any discount. */
    public $total_before_discount;

    /**
     * Executed every time a model is created.
     */
    public function init()
    {
        parent::init();

        // new attribute to store the original value of total attribute.
        $this->total_before_discount = $this->total;
    }
}
