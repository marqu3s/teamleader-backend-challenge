<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 20:55
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\services;

use \api\helpers\DataHelper;
use \yii\web\NotFoundHttpException;

/**
 * This class act as a Customer Service API.
 */
class CustomerService
{
    /**
     * Return the information for a customer
     *
     * @param string|integer $id the ID of a customer.
     */
    public static function getCustomer($id)
    {
        $customers = DataHelper::loadCustomers();
        foreach ($customers as $customer) {
            if ((int)$customer['id'] === (int)$id) {
                return $customer;
            }
        }

        throw new NotFoundHttpException('The customer was not found.');
    }
}
