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
use Destiny\Objects\GroupMember;
use Httpful\Request;
use Httpful\Response;


class Client
{
    /**
     * 
     */
    const URI = "https://www.bungie.net/Platform";

    /**
     * @var string $apiKey
     */
    public $apiKey;
    
    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
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
     * @param string $uri
     * @return object
     * @throws ClientException
     */
    protected function getResponse($uri) {
        $response = Request::get($uri)->addHeader('X-API-Key', $this->apiKey)->send()->body;

        if($response->ErrorStatus != "Success") {
            throw new ClientException();
        }

        return $response->Response;
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetMembersOfGroup.html#operation_get_GroupV2-GetMembersOfGroup
     */
    public function getClanMembers($clanID, $currentPage = 1) {
        $response = $this->getResponse($this->_buildRequestString('GroupV2', [$clanID, 'Members'], ['currentPage' => $currentPage]));

        return $response->results;
    }

}