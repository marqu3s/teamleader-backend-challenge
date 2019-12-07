<?php

use api\services\OrderService;

class Order1DiscountCest
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
        $order = OrderService::getOrder(1);

        $I->wantToTest('discounts applied to order 1.');
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('/discounts', $order);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        // Verify if order total is equals to 49.9
        $total = $I->grabDataFromResponseByJsonPath('$.total');
        $I->assertEquals(49.9, $total[0]);

        // Verify if item quantity is equals to 12
        $qty = $I->grabDataFromResponseByJsonPath('$.items[0].quantity');
        $I->assertEquals(12, $qty[0]);
    }
}
