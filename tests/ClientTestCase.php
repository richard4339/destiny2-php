<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Tests;

use PHPUnit\Framework\TestCase;

class ClientTestCase extends TestCase
{

    const TEST_API_KEY = '26765207';

    /**
     * @var \Destiny\Client
     */
    protected $client;

    /**
     * @throws \Destiny\Exceptions\ApiKeyException
     */
    protected function setUp()
    {
        $this->client = new \Destiny\Client(self::TEST_API_KEY);
    }


}