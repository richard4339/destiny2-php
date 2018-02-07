<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Tests;

class ClientOauthTestCase extends ClientTestCase
{

    const TEST_OAUTH_TOKEN = 'ABC123';

    /**
     * @throws \Destiny\Exceptions\ApiKeyException
     */
    protected function setUp()
    {
        $this->client = new \Destiny\Client(self::TEST_API_KEY, self::TEST_OAUTH_TOKEN);
    }


}