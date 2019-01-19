<?php
/**
 * destiny2-php
 */

namespace Destiny\Tests;

use Psr\Http\Message\ResponseInterface;

/**
 * Class GenericTest
 * @package Destiny\Tests
 */
class GenericTest extends ClientTestCase
{

    /**
     * Tests against code 5 which specifies that the API is offline
     *
     * @expectedException \Destiny\Exceptions\ClientException
     * @expectedExceptionCode 5
     */
    public function testClanKickMemberInvalidMember()
    {
        $this->client->setMock(__DIR__ . '/static/errorCode5.json');

        $this->client->getGlobalAlerts();
    }

    /**
     *
     */
    public function testGetGlobalAlertsNoStreamingWithResults() {
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts.json');

        $results = $this->client->getGlobalAlerts();

        $this->assertNotEmpty($results);
        $this->assertEquals(1, $this->count($results));
        $this->assertEquals("D2-OfflineSoonToday", $results[0]->AlertKey());
        $this->assertEquals("Destiny 2 will be temporarily offline today for scheduled maintenance. Please stay tuned to @BungieHelp for updates.", $results[0]->AlertHtml());
        $this->assertEquals(new \DateTime("2018-12-04T13:48:36Z"), $results[0]->AlertTimestamp());
        $this->assertEquals("https://www.bungie.net/en/Help/Article/13125", $results[0]->AlertLink());
        $this->assertEquals(3, $results[0]->AlertLevel());
        $this->assertEquals(0, $results[0]->AlertType());
    }

    /**
     *
     */
    public function testGetGlobalAlertsNoStreamingWithNoResults() {
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts-NoAlerts.json');

        $results = $this->client->getGlobalAlerts();

        $this->assertEmpty($results);
    }

    /**
     *
     */
    public function testGatewayErrorRetry() {
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts-NoAlerts.json', 504);
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts-NoAlerts.json', 504);
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts-NoAlerts.json');

        $results = $this->client->getGlobalAlerts();

        $this->assertEmpty($results);
    }

    /**
     *
     */
    public function testThrottleRetry() {
        $this->client->buildMock('', 31, 'Throttled', 3, 'Throttled', null, 429);
        $this->client->setMock(__DIR__ . '/static/throttled.json', 429);
        $this->client->setMock(__DIR__ . '/static/getGlobalAlerts-NoAlerts.json');

        $results = $this->client->getGlobalAlerts();

        $this->assertEmpty($results);
    }

}
