<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 22:37
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\discounts;

use api\models\Customer;
use api\models\Order;
use api\models\Product;

/**
 * Class ToolsDiscount
 * If you buy two or more products of category "Tools" (id 1),
 * you get a 20% discount on the cheapest product.
 *
 * @package api\discounts
 */
class ToolsDiscount implements IDiscount
{
    const PRODUCT_CATEGORY_ID = 1;
    const DISCOUNT_VALUE = 0.2;
    const DISCOUNT_CODE = 'tools';
    const DISCOUNT_DESCRIPTION = 'Tools - 20% on cheapest product';

    /**
     * This must be called to evaluate the order and apply the discount.
     *
     * @var Order $order
     * @var Customer $customer
     * @var Product[]|null $products Models of products in the order.
     */
    public function apply(&$order, $customer, $products = null)
    {
        $cheapestItemIndex = 0;
        $itemsInCategory = 0;

        // Check each item in the order and their category.
        foreach ($order->items as $i => $item) {
            $product = $products[$item->product_id];
            if ((int)$product->category === self::PRODUCT_CATEGORY_ID) {
                $itemsInCategory++;

                if ($order->items[$cheapestItemIndex]->unit_price > $item->unit_price) {
                    $cheapestItemIndex = $i;
                }
            }
        }

        // The cheapestItemIndex variable will contain the index of the cheapest item in the order.
        if ($itemsInCategory >= 2) {
            // Calculate the discount.
            $discount = $order->items[$cheapestItemIndex]->total * self::DISCOUNT_VALUE;

            // Apply it to the order item.
            $order->items[$cheapestItemIndex]->total -= $discount;

            // Apply it to the order total.
            $order->total -= $discount;

            // Apply the discount information in the order.
            $order->discounts_descriptions[self::DISCOUNT_CODE] = self::DISCOUNT_DESCRIPTION .
                " (item {$order->items[$cheapestItemIndex]->product_id} got 20% discount)";
        }
    }
}
