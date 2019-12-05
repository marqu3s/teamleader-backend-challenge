<?php
/**
 * User: joao
 * Date: 04/12/19
 * Time: 18:49
 *
 * @author João Marques <joao@jjmf.com>
 */

namespace api\controllers;

use \api\helpers\DataHelper;
use \api\models\Order;
use \Yii;
use \yii\rest\Controller;

/**
 * DiscountController (use name in singular form).
 * This controllet handles all the DISCOUNT service endpoints.
 *
 * @author João Marques <joao@jjmf.com>
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
        // In this exercice, for simplicity, remove rateLimiter behavior
        // which requires an authenticated user to work.
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);
        return $behaviors;
    }

    /**
     * Default controller action.
     */
    public function actionIndex()
    {
        // Get order from de request body.
        $order = Yii::$app->request->bodyParams;

        // Adjust attributes' names and values.
        $order = DataHelper::adjustAttributeNamesAndValues($order);

        // Instantiate a new Order model with the values received in the request.
        $orderModel = new Order($order);

        // Process the discounts.
        $orderModel->applyDiscounts();

        return $orderModel;
    }
}
