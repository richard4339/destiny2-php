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
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class GroupTest
 */
class GroupTest extends ClientOauthTestCase
{

    const TEST_CLANID = "2114315";

    /**
     *
     */
    public function testGetGroupByID()
    {

        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $user = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals('The Warren', $user->detail()->name());
    }

    /**
     *
     */
    public function testGetGroupFounder()
    {

        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $user = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals('richard4339', $user->founder()->destinyUserInfo()->displayName());
    }

    /**
     *
     */
    public function testGetGroupFeatureUpdateBannerPermissionOverride()
    {
        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $permission = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals(true, $permission->detail()->features()->updateBannerPermissionOverride());

    }

}
