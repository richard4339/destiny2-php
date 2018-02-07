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

class UserTest extends ClientOauthTestCase
{

    const TEST_ID = "2114315";

    /**
     * @expectedException \Destiny\Exceptions\ApiKeyException
     */
    public function testInvalidAPIKey()
    {
        $this->client->setMock(__DIR__ . '/static/invalidApiKey.json');

        $this->client->getCurrentBungieUser();
    }

    /**
     *
     */
    public function testGetCurrentDisplayName() {

        $this->client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $user = $this->client->getCurrentBungieUser();

        $this->assertEquals('ImASample', $user->displayName());
    }

    /**
     *
     */
    public function testInvalidGetCurrentDisplayName() {

        $this->client->setMock(__DIR__ . '/static/getCurrentUser.json');

        $user = $this->client->getCurrentBungieUser();

        $this->assertNotEquals('ImABadName', $user->displayName());
    }

    /**
     * @expectedException \Destiny\Exceptions\ClientException
     * @expectedExceptionCode 205
     */
    public function testGetBungieUserInvalidID()
    {
        $this->client->setMock(__DIR__ . '/static/getBungieUserInvalidID.json');

        $this->client->getBungieUser(self::TEST_ID);
    }

}
