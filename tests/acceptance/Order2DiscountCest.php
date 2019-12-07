<?php

use api\services\OrderService;

class Order2DiscountCest
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
        $order = OrderService::getOrder(2);

        $I->wantToTest('discounts applied to order 2.');
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('/discounts', $order);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        // Verify if order total is equals to 22.46
        $total = $I->grabDataFromResponseByJsonPath('$.total');
        $I->assertEquals(22.46, $total[0]);

        // Verify if item quantity is equals to 6
        $qty = $I->grabDataFromResponseByJsonPath('$.items[0].quantity');
        $I->assertEquals(6, $qty[0]);
    }
}
