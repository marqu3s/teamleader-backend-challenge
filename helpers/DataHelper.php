<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 18:49
 *
 * @author João Marques <joao@jjmf.com>
 */

 namespace api\helpers;

 use \yii\helpers\ArrayHelper;

/**
 * DataHelper
 * Data utility functions. This class loads data from the JSON files
 * and also apply standardization in the properties names.
 */
class DataHelper
{
    /**
     * This function will format attribute names by replacing '-' by '_'.
     * By using underscores we can massivelly assign values to a model's attributes.
     * It's a framework feature.
     *
     * It will also cast numeric values to float.
     *
     * @param array $array
     *
     * @return array
     */
    public static function adjustAttributeNamesAndValues($array)
    {
        $newArray = [];

        foreach ($array as $attrName => $value) {
            $attrName = str_replace('-', '_', $attrName);
            if (is_array($value)) {
                $newArray[$attrName] = self::adjustAttributeNamesAndValues($value);
            } elseif (is_numeric($value)) {
                $newArray[$attrName] = (float) $value;
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
        $data = \file_get_contents(__DIR__ . '/../data/customers.json');
        $data = \json_decode($data, true);
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
        $data = \file_get_contents(__DIR__ . '/../data/products.json');
        $data = \json_decode($data, true);
        $data = self::adjustAttributeNamesAndValues($data);
        $data = ArrayHelper::index($data, 'id');

        return $data;
    }
}
