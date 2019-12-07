<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 21:41
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\discounts;

use api\models\Customer;
use api\models\Order;
use api\models\Product;

/**
 * Class SwitchesDiscount
 * For every product of category "Switches" (id 2),
 * when you buy five, you get a sixth for free.
 *
 * For 5 items, get 1 free
 * For 10 items, get 2 free
 * For 15 ... you got the idea.
 *
 * @package api\discounts
 */
class SwitchesDiscount implements IDiscount
{
    const PRODUCT_CATEGORY_ID = 2;
    const SALE_QUANTITY = 5;
    const DISCOUNT_CODE = 'switches';
    const DISCOUNT_DESCRIPTION = 'Switches - buy 5 take 6';

    /**
     * This must be called to evaluate the order and apply the discount.
     *
     * @var Order $order
     * @var Customer $customer
     * @var Product[]|null $products Models of products in the order.
     */
    public function apply(&$order, $customer, $products = null)
    {
        // Check each item in the order, their category and quantities.
        foreach ($order->items as $i => $item) {
            $product = $products[$item->product_id];
            if ((int)$product->category === self::PRODUCT_CATEGORY_ID && $item->quantity >= self::SALE_QUANTITY) {
                // How many items the customer will get for free?
                $freeItems = floor($item->quantity / self::SALE_QUANTITY);

                // Add the free quantity to the order item.
                $order->items[$i]->quantity += $freeItems;

                // Apply the discount information in the order.
                $order->discounts_descriptions[self::DISCOUNT_CODE] = self::DISCOUNT_DESCRIPTION . " (item {$item->product_id} has given {$freeItems} more units)";
            }
        }
    }
}
