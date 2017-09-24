<?php

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
     * @expectedException Error
     */
    public function testInvalidAPIKey()
    {
        $client = $this->createClient(__DIR__ . '/static/invalidApiKey.json');

        $client->getClanMembers(self::TEST_CLANID);
    }

    /**
     * Creates the Client class instance for mockups
     *
     * @param $responseFile
     * @param int $statusCode HTTP Response Code (Defaults to 200)
     * @return Client
     */
    public function createClient($responseFile, $statusCode = 200) {


        $mock = new MockHandler([
            new Response($statusCode, ['Content-Type' => 'application/json'], file_get_contents($responseFile))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new GuzzleClient(['handler' => $handler]);

        $client = new Client(self::TEST_API_KEY);
        $client->httpClient = $client;

        return $client;
    }

}
