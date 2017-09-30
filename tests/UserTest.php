<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-28 14:38 CDT by richard
 *
 */

use Destiny\Client;

class UserTest extends PHPUnit_Framework_TestCase
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
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testMissingOAuthKeyWhenRequired()
    {
        $client = new Client(self::TEST_API_KEY);
        $client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $client->getCurrentBungieUser();
    }

    /**
     *
     */
    public function testGetCurrentDisplayName() {

        $client = new Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
        $client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $user = $client->getCurrentBungieUser();

        $this->assertEquals('ImASample', $user->displayName());
    }

    /**
     *
     */
    public function testInvalidGetCurrentDisplayName() {

        $client = new Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
        $client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $user = $client->getCurrentBungieUser();

        $this->assertNotEquals('ImABadName', $user->displayName());
    }

    /**
     * @expectedException \Destiny\Exceptions\ClientException
     * @expectedExceptionCode 205
     */
    public function testGetBungieUserInvalidID()
    {
        $client = new Client(self::TEST_API_KEY);
        $client->setMock(__DIR__ . '/static/getBungieUserInvalidID.json');

        $client->getBungieUser(self::TEST_CLANID);
    }

}
