<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 *
 */

namespace Destiny;

use Destiny\Enums\BungieMembershipType;
use Destiny\Enums\DestinyComponentType;
use Destiny\Enums\GroupType;
use Destiny\Exceptions\ClientException;
use Destiny\Exceptions\ApiKeyException;
use Destiny\Exceptions\OAuthException;
use Destiny\Objects\DestinyCharacterComponent;
use Destiny\Objects\DestinyProfileComponent;
use Destiny\Objects\DestinyProfileResponse;
use Destiny\Objects\DestinyVendorResponse;
use Destiny\Objects\GeneralUser;
use Destiny\Objects\GroupMember;
use Destiny\Objects\GroupResponse;
use Destiny\Objects\PublicPartnershipDetail;
use Destiny\Objects\Vendor;
use Destiny\Objects\VendorSale;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class Client
 * @package Destiny
 *
 * Some of get functions do require an OAuth token for access. If you do not pass an OAuth token for functions that do
 * not require it, that is fine. However, if you pass an invalid OAuth token to ANY function regardless of its
 * requirements you will get an OAuthException
 *
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
     * @var string Destiny Application Client ID
     * @link https://www.bungie.net/en/Application/
     */
    protected $_clientID;

    /**
     * @var string Destiny Application Client Secret (for confidential only)
     * @link https://www.bungie.net/en/Application/
     */
    protected $_clientSecret;

    /**
     * @var string Destiny OAuth Token
     */
    protected $_oauthToken;

    /**
     * @var GuzzleClient $_httpClient
     */
    protected $_httpClient;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $_appName;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $_appVersion;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $_appIDNumber;

    /**
     * Used for User-Agent field
     * Do not include http:// or similar, ex. www.sample.net
     * @var string
     */
    protected $_appURL;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $_appEmail;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param null|string $token
     * @param null|string $clientID
     * @param null|string $clientSecret
     * @throws ApiKeyException
     */
    function __construct(string $apiKey = '', ?string $token = null, ?string $clientID = null, ?string $clientSecret = null, ?string $appName = '', ?string $appVersion = '', ?string $appIDNumber = '', ?string $appURL = '', ?string $appEmail = '')
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

        if (!empty($clientID)) {
            $this->_clientID = $clientID;
        }

        if (!empty($clientSecret)) {
            $this->_clientSecret = $clientSecret;
        }

        if (!empty($appName)) {
            $this->_appName = $appName;
        }

        if (!empty($appVersion)) {
            $this->_appVersion = $appVersion;
        }

        if (!empty($appIDNumber)) {
            $this->_appIDNumber = $appIDNumber;
        }

        if (!empty($appURL)) {
            $this->_appURL = $appURL;
        }

        if (!empty($appEmail)) {
            $this->_appEmail = $appEmail;
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     *
     * @deprecated 0.2.0 Since these are simply placeholder/helper wrappers and we want to keep things consistent, use
     * the new get/set functions instead
     */
    public function __get($name)
    {

        switch (strtoupper($name)) {
            case 'CLIENTID':
            case 'APIKEY':
                return $this->_apiKey;
                break;
            default:
                return $this->$name;
                break;
        }
    }

    /**
     * @param $url
     * @return mixed
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($url)
    {

        if (empty($this->_apiKey)) {
            throw new ApiKeyException("API Key is not set");
        }

        $userAgent = sprintf('%s/%s AppId/%s (+%s;%s)', $this->_appName ?? '', $this->_appVersion ?? '', $this->_appIDNumber ?? '', $this->_appURL ?? '', $this->_appEmail ?? '');

        $headers = [
            'User-Agent' => $userAgent,
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
        $url = sprintf("%s/%s/%s/?%s", self::URI, $endpoint, implode("/", $uriParams), $query);
        return $url;
    }

    /**
     * @param string[]|int[] $components
     * @param string[]|int[] $allowedComponents
     * @return bool
     */
    protected static function _validateComponents(array $components, array $allowedComponents): bool
    {
        $allowed = [];
        foreach ($allowedComponents as $i) {
            if (is_int($i)) {
                $allowed[] = DestinyComponentType::getLabel($i);
            } else {
                $allowed[] = $i;
            }
        }
        foreach ($components as $i) {
            if (is_int($i)) {
                $i = DestinyComponentType::getLabel($i);
            }
            if (!in_array($i, $allowed)) {
                return false;
            }
            return true;
        }
    }

    /**
     * Get a Bungie group either by name with grouptype or by groupID (grouptype is ignored with a groupID).
     * Note that a group with a numeric only name will not work here as this function will see it as a groupID
     *
     * There is a bug currently in the Bungie API that is causing lookup by name to not always function when names have
     * a space in them. See https://github.com/Bungie-net/api/issues/162
     *
     * @param string|int $group
     * @param string|int $groupType
     * @return GroupResponse
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * OAuth token optional. Passing an OAuth token for a user in the requested group will cause it to return more info.
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetGroupByName.html#operation_get_GroupV2-GetGroupByName
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetGroup.html#operation_get_GroupV2-GetGroup
     */
    public function getGroup($group, $groupType = GroupType::CLAN)
    {
        if (is_integer($group)) {
            $response = $this->request($this->_buildRequestString('GroupV2', [$group]));
        } else {
            $response = $this->request($this->_buildRequestString('GroupV2', ['Name', $group, $groupType]));
        }
        return GroupResponse::makeFromArray($response['Response']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
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
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
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
     * @return GeneralUser
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
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
     * @param int|string $membershipType
     * @param int $membershipID
     * @param string[]|int[] $components
     *
     * @return mixed
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getProfile($membershipType, $membershipID, ...$components)
    {
        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $params = [];
        foreach ($components as $i) {
            if (is_int($i)) {
                $params[] = DestinyComponentType::getLabel($i);
            } else {
                $params[] = $i;
            }
        }

        $response = $this->request($this->_buildRequestString('Destiny2', [$membershipType, 'Profile', $membershipID], ['components' => implode(',', $params)]));

        $profileResponse = new DestinyProfileResponse();
        $profileResponse->profile = DestinyProfileComponent::makeFromArray($response['Response']['profile']);

        $profileResponse->characters = array_map(function ($item) {
            return DestinyCharacterComponent::makeFromArray($item);
        }, $response['Response']['characters']['data']);

        return $profileResponse;

    }

    /**
     * Gets the absolute path on https://www.bungie.net to the mobileWorldContentPath for the given locale (defaults to en)
     * @param string $locale Defaults to en.
     * @return string
     */
    public function getMobileWorldContentsPath($locale = "en")
    {
        $response = $this->request($this->_buildRequestString('Destiny2', ['Manifest']));

        return $response['Response']['mobileWorldContentPaths'][$locale];
    }

    /**
     * @param int $userID
     * @return GeneralUser
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_User-GetBungieNetUserById.html#operation_get_User-GetBungieNetUserById
     */
    public function getBungieUser($userID)
    {
        $response = $this->request($this->_buildRequestString('User', ['GetBungieNetUserById', $userID]));

        return GeneralUser::makeFromArray($response['Response']);
    }

    /**
     * @return array
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getMembershipDataForCurrentUser()
    {
        if (empty($this->_oauthToken)) {
            throw new OAuthException('401 Unauthorized');
        }
        $response = $this->request($this->_buildRequestString('User', ['GetMembershipsForCurrentUser']));

        return [
            $response['Response']['destinyMemberships'], //TODO:  make UserInfoCard
            GeneralUser::makeFromArray($response['Response']['bungieNetUser'])
        ];
    }

    /**
     * @param int|string $membershipType
     * @param int $membershipID
     * @return mixed
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getBungieAccount($membershipType, $membershipID)
    {
        $response = $this->request($this->_buildRequestString('User', ['GetBungieAccount', $membershipID, $membershipType]));

        return $response;

    }

    /**
     * @param int|string $membershipType
     * @param int $membershipID
     * @return mixed
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getGroupV2User($membershipType, $membershipID)
    {
        $response = $this->request($this->_buildRequestString('GroupV2', ['User', $membershipType, $membershipID, 0, 1]));

        return $response['Response']['results'];

    }

    /**
     * @param int|string $membershipType A valid non-BungieNet membership type. See: BungieMembershipType
     * @param string $membershipID Destiny membership ID of another user. You may be denied.
     * @param string $characterID The Destiny Character ID of the character for whom we're getting vendor info.
     * @param string|null $vendor [Optional] The Hash identifier of the Vendor to be returned.
     * @param string[]|int[] $components The components to fetch. At most this can be Vendors, VendorCategories, and VendorSale
     *
     * @return DestinyVendorResponse
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @todo Support VendorCategories, cannot currently handle multiple vendors being passed by leaving vendor null
     *
     * @link https://bungie-net.github.io/multi/operation_get_Destiny2-GetVendor.html#operation_get_Destiny2-GetVendor
     *
     * @example To get Xur (this is the actual hash for Xur): $client->getVendor(BungieMembershipType::TIGERPSN, '12345', '67890', '2190858386', DestinyComponentType::VENDORS);
     */
    public function getVendor($membershipType, string $membershipID, string $characterID, ?string $vendor = null, ...$components)
    {
        if (empty($this->_oauthToken)) {
            throw new OAuthException('401 Unauthorized');
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $params = [];
        foreach ($components as $i) {
            if (is_int($i)) {
                $params[] = DestinyComponentType::getLabel($i);
            } else {
                $params[] = $i;
            }
        }

        if (!self::_validateComponents($params, [
            DestinyComponentType::VENDORS,
            DestinyComponentType::VENDORCATEGORIES,
            DestinyComponentType::VENDORSALES
        ])) {
            throw new ClientException('One or more of the supplied components is not valid for this call.');
        }

        $uriParams = [$membershipType, 'Profile', $membershipID, 'Character', $characterID, 'Vendors'];

        if (!empty($vendor)) {
            $uriParams[] = $vendor;
        }
        $response = $this->request($this->_buildRequestString('Destiny2', $uriParams, ['components' => implode(',', $params)]));

        $profileResponse = new DestinyVendorResponse();
        if (isset($response['Response']['vendor']['data'])) {
            $profileResponse->vendor = Vendor::makeFromArray($response['Response']['vendor']['data']);
        }

        if (isset($response['Response']['sales']['data'])) {
            $profileResponse->sales = array_map(function ($item) {
                return VendorSale::makeFromArray($item);
            }, $response['Response']['sales']['data']);
        }

        return $profileResponse;

    }

    /**
     * @param int $userID
     * @return PublicPartnershipDetail
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_User-GetPartnerships.html#operation_get_User-GetPartnerships
     */
    public function getPartnerships($userID)
    {
        $response = $this->request($this->_buildRequestString('User', [$userID, 'Partnerships']));

        if (empty($response['Response'])) {
            throw new ClientException('No results found');
        }
        return PublicPartnershipDetail::makeFromArray($response['Response'][0]);
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

    /**
     * @return null|string
     */
    public function getApiKey(): ?string
    {
        return $this->_apiKey;
    }

    /**
     * @param null|string $apiKey
     * @return Client
     */
    public function setApiKey(?string $apiKey): Client
    {
        $this->_apiKey = $apiKey;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientID(): ?string
    {
        return $this->_clientID;
    }

    /**
     * @param null|string $clientID
     * @return Client
     */
    public function setClientID(?string $clientID): Client
    {
        $this->_clientID = $clientID;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientSecret(): ?string
    {
        return $this->_clientSecret;
    }

    /**
     * @param null|string $clientSecret
     * @return Client
     */
    public function setClientSecret(?string $clientSecret): Client
    {
        $this->_clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOauthToken(): ?string
    {
        return $this->_oauthToken;
    }

    /**
     * @param null|string $oauthToken
     * @return Client
     */
    public function setOauthToken(?string $oauthToken): Client
    {
        $this->_oauthToken = $oauthToken;
        return $this;
    }


}
