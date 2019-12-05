<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 21:48
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\services;

use \api\helpers\DataHelper;
use \yii\web\NotFoundHttpException;

/**
 * This class act as a Product Service API.
 */
class ProductService
{
    /**
     * Return the information for a product.
     *
     * @param string|integer $id the ID of a product.
     */
    public static function getProduct($id)
    {
        $products = DataHelper::loadProducts();
        foreach ($products as $product) {
            if ($product['id'] === $id) {
                return $product;
            }
        }

        throw new NotFoundHttpException('The product was not found.');
    }
}
