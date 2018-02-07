<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Tests;

use Destiny\Client;

class OauthTest extends ClientTestCase
{

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testInvalidOAuthKey()
    {
        $this->client->setMock(__DIR__ . '/static/invalidApiKey.json', 401);

        $this->client->getCurrentBungieUser();
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testMissingOAuthKeyWhenRequired()
    {
        $this->client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $this->client->getCurrentBungieUser();
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testVendorMissingOAuthKeyWhenRequired()
    {
        $this->client->setMock(__DIR__ . '/static/getVendorCategoriesSalesDisabled.json');

        $vendor = $this->client->getVendor(\Destiny\Enums\BungieMembershipType::TIGERBLIZZARD, 'ABC123', 'ABC123', 'ABC123', \Destiny\Enums\DestinyComponentType::VENDORS);
    }

}
