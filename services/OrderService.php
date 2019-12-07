<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 20:55
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\services;

use api\helpers\DataHelper;

/**
 * Class OrderService
 * This class act is mainly used to get order example for testing purposes.
 *
 * @package api\services
 */
class OrderService
{
    /**
     * Return an example order.
     *
     * @param string|integer $id the ID of an order.
     *
     * @return mixed
     */
    public static function getOrder($id)
    {
        return DataHelper::loadOrder($id);
    }
}
