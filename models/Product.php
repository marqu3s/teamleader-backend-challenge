<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 21:54
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\models;

use \yii\base\Model;

/**
 * Product model.
 * This model represents a product.
 */
class Product extends Model
{
    /** @var string $id */
    public $id;

    /** @var string $description */
    public $description;

    /** @var integer $category */
    public $category;

    /** @var float $price */
    public $price;
}
