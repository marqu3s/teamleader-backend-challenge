<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 20:35
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\models;

use yii\base\Model;

/**
 * Class Customer
 * Customer model. This model represents a customer associated with an order.
 *
 * @package api\models
 */
class Customer extends Model
{
    /** @var integer $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $since */
    public $since;

    /** @var float $revenue */
    public $revenue;
}
