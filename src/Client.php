<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license http://www.gnu.org/licenses/ GPLv3
 * @version 0.1
 *
 * Built 2017-09-23 09:51 CDT by richard
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 */

namespace Destiny;

use Destiny\Exceptions\ClientException;
use Destiny\Exceptions\ApiKeyException;
use Destiny\Exceptions\OAuthException;
use Destiny\Objects\GeneralUser;
use Destiny\Objects\GroupMember;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class Client
 * @package Destiny
 */
class Client
{
    /**
     *
     */
    const URI = "https://www.bungie.net/Platform";

    /**
     * @var string Destiny API Key
     */
    protected $_apiKey;

    /**
     * @var string Destiny OAuth Token
     */
    protected $_oauthToken;

    /**
     * @var GuzzleClient $_httpClient
     */
    protected $_httpClient;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param null $token
     * @throws ApiKeyException
     */
    function __construct($apiKey = '', $token = null)
    {
        if (empty($apiKey)) {
            $apiKey = $_ENV["APIKEY"];
        }

        if (empty($apiKey)) {
            throw new ApiKeyException("API Key is not set");
        }

        $this->_apiKey = $apiKey;

        if (!empty($token)) {
            $this->_oauthToken = $token;
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {

        switch (strtoupper($name)) {
            case 'CLIENTID':
            case '_CLIENTID':
            case 'APIKEY':
            case '_APIKEY':
                return $this->_apiKey;
                break;
            default:
                return $this->$name;
                break;
        }
    }

    /**
     * @param string $url
     * @return mixed
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    protected function request($url)
    {

        if (empty($this->_apiKey)) {
            throw new ApiKeyException("API Key is not set");
        }

        $headers = [
            'X-Api-Key' => $this->_apiKey
        ];

        if (!empty($this->_oauthToken)) {
            $headers['Authorization'] = sprintf('Bearer %s', $this->_oauthToken);
        }

        try {
            $response = $this->getHttpClient()
                ->request('GET', $url, [
                    'headers' => $headers
                ]);
        } catch (GuzzleClientException $x) {
            switch ($x->getCode()) {
                case 401:
                    throw new OAuthException('401 Unauthorized');
                    break;
            }
        }

        $body = ResponseMediator::convertResponseToArray($response);

        switch ($body['ErrorCode']) {
            case 1:
                return $body;
                break;
            case 2101:
                throw new ApiKeyException($body['Message'], $body['ErrorCode'], $body['ThrottleSeconds'],
                    $body['ErrorStatus']);
                break;
            default:
                throw new ClientException($body['Message'], $body['ErrorCode'], $body['ThrottleSeconds'],
                    $body['ErrorStatus']);
                break;
        }
    }

    /**
     * @return GuzzleClient
     */
    protected function getHttpClient()
    {
        if ($this->_httpClient === null) {
            $this->_httpClient = new GuzzleClient(['base_uri' => self::URI, 'verify' => false]);
        }

        return $this->_httpClient;
    }

    /**
     * @param string $endpoint
     * @param array|null $uriParams
     * @param array|null $queryParams
     * @return string
     */
    protected function _buildRequestString($endpoint, array $uriParams = null, array $queryParams = null)
    {
        $query = '';
        if (!empty($queryParams)) {
            $query = http_build_query($queryParams);
        }
        return sprintf("%s/%s/%s/?%s", self::URI, $endpoint, implode("/", $uriParams), $query);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetMembersOfGroup.html#operation_get_GroupV2-GetMembersOfGroup
     */
    public function getClanMembers($clanID, $currentPage = 1)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'Members'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetAdminsAndFounderOfGroup.html#operation_get_GroupV2-GetAdminsAndFounderOfGroup
     */
    public function getClanAdminsAndFounder($clanID, $currentPage = 1)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetBannedMembersOfGroup.html#operation_get_GroupV2-GetBannedMembersOfGroup
     *
     * @todo Requires OAuth which is not yet implemented
     */
    public function getClanBannedMembers($clanID, $currentPage = 1)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetPendingMemberships.html#operation_get_GroupV2-GetPendingMemberships
     *
     * @todo Requires OAuth which is not yet implemented
     */
    public function getClanPendingMembers($clanID, $currentPage = 1)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetInvitedIndividuals.html#operation_get_GroupV2-GetInvitedIndividuals
     *
     * @todo Requires OAuth which is not yet implemented
     */
    public function getClanInvitedMembers($clanID, $currentPage = 1)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @return GeneralUser
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getCurrentBungieUser()
    {
        if (empty($this->_oauthToken)) {
            throw new OAuthException('401 Unauthorized');
        }
        $response = $this->request($this->_buildRequestString('User', ['GetCurrentBungieNetUser']));

        return GeneralUser::makeFromArray($response['Response']);
    }

    /**
     * @param int $userID
     * @return GeneralUser
     * @throws ApiKeyException
     * @throws ClientException
     *
     * @link https://bungie-net.github.io/multi/operation_get_User-GetBungieNetUserById.html#operation_get_User-GetBungieNetUserById
     */
    public function getBungieUser($userID)
    {
        $response = $this->request($this->_buildRequestString('User', ['GetBungieNetUserById', $userID]));

        return GeneralUser::makeFromArray($response['Response']);
    }


    /**
     * Shim for testing the API
     *
     * @param string $responseFile
     * @param int $statusCode HTTP Response Code (Defaults to 200)
     */
    public function setMock($responseFile, $statusCode = 200)
    {


        $mock = new MockHandler([
            new Response($statusCode, ['Content-Type' => 'application/json'], file_get_contents($responseFile))
        ]);

        $handler = HandlerStack::create($mock);
        $this->_httpClient = new GuzzleClient(['handler' => $handler]);
    }

}