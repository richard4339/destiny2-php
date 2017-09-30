<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-24 14:30 CDT by richard
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

}
