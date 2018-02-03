<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

use Destiny\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class GroupTest
 */
class GroupTest extends PHPUnit_Framework_TestCase
{

    const TEST_OAUTH_TOKEN = 'ABC123';
    const TEST_API_KEY = '26765207';
    const TEST_CLANID = "2114315";

    /**
     * @expectedException \Destiny\Exceptions\ApiKeyException
     */
    public function testInvalidAPIKey()
    {
        $client = new Client(self::TEST_API_KEY);
        $client->setMock(__DIR__ . '/static/invalidApiKey.json');

        $client->getClanMembers(self::TEST_CLANID);
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testInvalidOAuthKey()
    {
        $client = new Client(self::TEST_API_KEY);
        $client->setMock(__DIR__ . '/static/invalidApiKey.json', 401);

        $client->getCurrentBungieUser();
    }

    /**
     *
     */
    public function testGetGroupByID() {

        $client = new Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
        $client->setMock(__DIR__ . '/static/getClan.json');

        $user = $client->getGroup(self::TEST_CLANID);

        $this->assertEquals('The Warren', $user->detail()->name());
    }

    /**
     *
     */
    public function testGetGroupFounder() {

        $client = new Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
        $client->setMock(__DIR__ . '/static/getClan.json');

        $user = $client->getGroup(self::TEST_CLANID);

        $this->assertEquals('richard4339', $user->founder()->destinyUserInfo()->displayName());
    }

    /**
     *
     */
    public function testGetGroupFeatureUpdateBannerPermissionOverride()
    {
        $client = new Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
        $client->setMock(__DIR__ . '/static/getClan.json');

        $permission = $client->getGroup(self::TEST_CLANID);

        $this->assertEquals(true, $permission->detail()->features()->updateBannerPermissionOverride());

    }

}
