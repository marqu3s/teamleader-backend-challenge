<?php

class PingCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function pingTest(AcceptanceTester $I)
    {
        $I->wantToTest('if API is up and running.');
        $I->sendAjaxGetRequest('/discounts/ping');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    }
}
