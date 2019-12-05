<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 21:11
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\discounts;

use \api\models\Customer;
use \api\models\Order;
use \api\models\Product;

/**
 * GoldClientDiscount
 * A customer who has already bought for over € 1000,
 * gets a discount of 10% on the whole order.
 */
class GoldClientDiscount implements IDiscount
{
    const REVENUE_TO_GOLD = 1000;
    const DISCOUNT_VALUE = 0.1;
    const DISCOUNT_CODE = 'gold_client';
    const DISCOUNT_DESCRIPTION = 'Gold Client - 10% on the whole order';

    /**
     * This must be called to evaluate the order and apply the discount.
     *
     * @var Order $order
     * @var Customer $customer
     * @var Product[]|null $products Models of products in the order.
     */
    public function apply(&$order, $customer, $products = null)
    {
        if ($customer->revenue > self::REVENUE_TO_GOLD) {
            // Calculate the new order total with the discount applied.
            $order->total -= $order->total * self::DISCOUNT_VALUE;

            // Apply the discount information in the order.
            $order->discounts_descriptions[self::DISCOUNT_CODE] = self::DISCOUNT_DESCRIPTION;
        }
    }
}
