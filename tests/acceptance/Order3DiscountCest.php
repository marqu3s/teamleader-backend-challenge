<?php

use api\services\OrderService;

class Order3DiscountCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests

    /**
     * @param ApiTester $I The test actor
     */
    public function discountTest(AcceptanceTester $I)
    {
        // Load a JSON object representing an order.
        $order = OrderService::getOrder(3);

        $I->wantToTest('discounts applied to order 3.');
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('/discounts', $order);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        // Verify if order total is equals to 65.1
        $total = $I->grabDataFromResponseByJsonPath('$.total');
        $I->assertEquals(65.1, $total[0]);

        // Verify if first item total is equals to 15.6
        $total = $I->grabDataFromResponseByJsonPath('$.items[0].total');
        $I->assertEquals(15.6, $total[0]);
    }
}
