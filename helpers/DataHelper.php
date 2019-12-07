<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 18:49
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\helpers;

use yii\helpers\ArrayHelper;
use function file_get_contents;
use function json_decode;

/**
 * Class DataHelper
 * Data utility functions. This class loads data from the JSON files
 * and also apply standardization in the properties names.
 *
 * @package api\helpers
 */
class DataHelper
{
    /**
     * This function will format attribute names by replacing '-' by '_' and vice versa.
     * By using underscores we can massivelly assign values to a model's attributes.
     * It's a framework feature.
     *
     * It will also cast numeric values to float.
     *
     * @param array $array
     * @param bool $originalStyle When true replaces '_' for '-'. When false replaces '-' for '_'.
     *
     * @return array
     */
    public static function adjustAttributeNamesAndValues($array, $originalStyle = false)
    {
        $newArray = [];

        if ($originalStyle) {
            $search = '_';
            $replace = '-';
        } else {
            $search = '-';
            $replace = '_';
        }

        foreach ($array as $attrName => $value) {
            $attrName = str_replace($search, $replace, $attrName);
            if (is_array($value)) {
                $newArray[$attrName] = self::adjustAttributeNamesAndValues($value, $originalStyle);
            } elseif (is_numeric($value)) {
                $newArray[$attrName] = (float)$value;
            } else {
                $newArray[$attrName] = $value;
            }
        }

        return $newArray;
    }

    /**
     * Loads the customers data.
     * For simplicity the service uses a json file to store customers data.
     * In a real world application this information must be stored in a database.
     *
     * @return array
     */
    public static function loadCustomers()
    {
        $data = file_get_contents(__DIR__ . '/../data/customers.json');
        $data = json_decode($data, true);
        $data = self::adjustAttributeNamesAndValues($data);
        $data = ArrayHelper::index($data, 'id');

        return $data;
    }

    /**
     * Loads the products data.
     * For simplicity the service uses a json file to store product data.
     * In a real world application this information must be stored in a database.
     *
     * @return array
     */
    public static function loadProducts()
    {
        $data = file_get_contents(__DIR__ . '/../data/products.json');
        $data = json_decode($data, true);
        $data = self::adjustAttributeNamesAndValues($data);
        $data = ArrayHelper::index($data, 'id');

        return $data;
    }

    /**
     * Loads an order data.
     * For simplicity the service uses a json file to store orders data.
     * In a real world application this information must be stored in a database.
     *
     * @return array
     */
    public static function loadOrder($id)
    {
        $data = file_get_contents(__DIR__ .  "/../data/order{$id}.json");
        $data = json_decode($data, true);
        //$data = self::adjustAttributeNamesAndValues($data);
        //$data = ArrayHelper::index($data, 'id');

        return $data;
    }
}
