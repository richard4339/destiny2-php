<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Tests;

/**
 * Class VendorDisabledTest
 */
class VendorDisabledTest extends ClientOauthTestCase
{

    /**
     * @throws \Destiny\Exceptions\ApiKeyException
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client->setMock(__DIR__ . '/static/getVendorCategoriesSalesDisabled.json');
    }

    /**
     * @throws \Destiny\Exceptions\ApiKeyException
     * @throws \Destiny\Exceptions\ClientException
     * @throws \Destiny\Exceptions\OAuthException
     */
    public function testIsVendorEnabledWhenNotPresent()
    {
        $vendor = $this->client->getVendor(\Destiny\Enums\BungieMembershipType::TIGERBLIZZARD, 'ABC123', 'ABC123', 'ABC123', \Destiny\Enums\DestinyComponentType::VENDORS);

        $this->assertEquals(false, $vendor->vendor->enabled());
    }

}
