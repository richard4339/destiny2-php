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
use Destiny\Objects\GroupMember;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Client as GuzzleClient;

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
     * @var GuzzleClient $httpClient
     */
    public $httpClient;

    /**
     * Client constructor.
     * @param string $apiKey
     * @throws ApiKeyException
     */
    function __construct($apiKey = '')
    {
        if (empty($apiKey)) {
            $apiKey = $_ENV["CLIENTID"];
        }

        if(empty($apiKey)) {
            throw new ApiKeyException("Client ID is not set");
        }

        $this->_apiKey = $apiKey;
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
     * @return array
     * @throws ApiKeyException
     * @throws GuzzleClientException
     */
    protected function request($url)
    {
        try {
            $reponse = $this->getHttpClient()
                ->request('GET', $url, [
                    'headers' => [
                        'X-Api-Key' => $this->_apiKey
                    ]
                ]);

            return ResponseMediator::convertResponseToArray($reponse);
        } catch (GuzzleClientException $x) {
            switch($x->getCode()) {
                case 400:
                    $response = $x->getResponse();
                    $body = ResponseMediator::convertResponseToArray($response);
                    if($body['message'] == 'Invalid client id specified') {
                        throw new ApiKeyException('Invalid client id specified');
                    } else {
                        throw $x;
                    }
                    break;
                default:
                    throw $x;
                    break;
            }
        }
    }

    /**
     * @return GuzzleClient
     */
    protected function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new GuzzleClient(['base_uri' => self::URI, 'verify' => false]);
        }

        return $this->httpClient;
    }

    /**
     * @param string $endpoint
     * @param array|null $uriParams
     * @param array|null $queryParams
     * @return string
     */
    protected function _buildRequestString($endpoint, array $uriParams = null, array $queryParams = null) {
        return sprintf("%s/%s/%s/?%s", self::URI, $endpoint, implode("/", $uriParams), http_build_query($queryParams));
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetMembersOfGroup.html#operation_get_GroupV2-GetMembersOfGroup
     */
    public function getClanMembers($clanID, $currentPage = 1) {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'Members'], ['currentPage' => $currentPage]));

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
    public function getClanAdminsAndFounder($clanID, $currentPage = 1) {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'], ['currentPage' => $currentPage]));

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
    public function getClanBannedMembers($clanID, $currentPage = 1) {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'], ['currentPage' => $currentPage]));

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
    public function getClanPendingMembers($clanID, $currentPage = 1) {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'], ['currentPage' => $currentPage]));

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
    public function getClanInvitedMembers($clanID, $currentPage = 1) {
        $response = $this->request($this->_buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'], ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

}