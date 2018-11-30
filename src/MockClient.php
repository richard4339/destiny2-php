<?php

namespace Destiny;


use GuzzleHttp\Psr7\Response;

/**
 * Class MockClient
 * @package Destiny
 *
 * Overloads the Client library and spits out JSON files used for creating tests
 *
 * @property-read string $mockFile
 */
class MockClient extends Client
{
    /**
     * @param string $file Filename only with no suffix, path and .json is set by the function
     * @throws \Exception
     */
    public function setMockFile(string $file) {

        $directory = __DIR__ . '/mock/';

        if(!file_exists($directory)) {
            if (!mkdir($directory)) {
                throw new \Exception('Unable to create the mock directory');
            }
        }

        $this->mockFile = $directory . $file . '-' . (new \DateTime())->format('YmdHis') . '.json';
    }

    public function getResponseBody(Response $response)
    {
        $json = parent::getResponseBody($response);

        file_put_contents($this->mockFile, $json);

        return $json;
    }

}