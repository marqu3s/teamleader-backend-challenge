<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 18:49
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\controllers;

use api\helpers\DataHelper;
use api\models\Order;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class DiscountController
 * DiscountController (use name in singular form).
 * This controller handles all the DISCOUNT service endpoints.
 *
 * @package api\controllers
 */
class DiscountController extends Controller
{
    /**
     * This is where all the behaviors that must be applied
     * to this controller should be configured.
     * https://www.yiiframework.com/doc/guide/2.0/en/concept-behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        // In this exercise, for simplicity, remove rateLimiter behavior
        // which requires an authenticated user to work.
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);

        return $behaviors;
    }

    /**
     * Default controller action.
     * This the action that get an order in the request body and apply any
     * available discount, according to the items in the order and the
     * customer.
     *
     * @return string The orderModel in JSON format.
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        // Get order from de request body.
        $order = Yii::$app->request->bodyParams;

        // Adjust attributes' names and values.
        $order = DataHelper::adjustAttributeNamesAndValues($order);

        // Instantiate a new Order model with the values received in the request.
        // Since models extends yii\base\BaseObject, we can pass object configuration
        // as an array, where the array keys are the object properties and
        // the array values are the values that must be assigned to the property.
        // @see https://www.yiiframework.com/doc/api/2.0/yii-base-baseobject
        $orderModel = new Order($order);

        // Process the discounts.
        $orderModel->applyDiscounts();

        return DataHelper::adjustAttributeNamesAndValues($orderModel->toArray(), true);
    }

    /**
     * Just a simple action to check if the API is running.
     *
     * @return string in JSON format
     */
    public function actionPing()
    {
        return ['response' => 'pong'];
    }
}
