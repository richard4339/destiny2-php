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
use Destiny\Enums\PlatformErrorCodes;
use Destiny\Exceptions\AuthException;
use Destiny\Exceptions\ClientException;
use Destiny\Exceptions\ApiKeyException;
use Destiny\Exceptions\Exception;
use Destiny\Exceptions\OAuthException;
use Destiny\Objects\ClanApproveMember;
use Destiny\Objects\DestinyCharacterComponent;
use Destiny\Objects\DestinyProfileComponent;
use Destiny\Objects\DestinyProfileResponse;
use Destiny\Objects\DestinyVendorResponse;
use Destiny\Objects\GeneralUser;
use Destiny\Objects\GlobalAlert;
use Destiny\Objects\GroupMember;
use Destiny\Objects\GroupMemberApplication;
use Destiny\Objects\GroupResponse;
use Destiny\Objects\PublicPartnershipDetail;
use Destiny\Objects\UserMembership;
use Destiny\Objects\Vendor;
use Destiny\Objects\VendorSale;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Http\Client\Common\Exception\ClientErrorException;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\ContentTypePlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RetryPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Exception as HttpClientException;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication\Bearer;
use Http\Message\MessageFactory;
use Http\Message\ResponseFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Class Client
 * @package Destiny
 *
 * Some of get functions do require an OAuth token for access. If you do not pass an OAuth token for functions that do
 * not require it, that is fine. However, if you pass an invalid OAuth token to ANY function regardless of its
 * requirements you will get an OAuthException
 *
 * GroupV2 Missing Methods
 * GET: GroupV2.GetAvailableAvatars
 * GET: GroupV2.GetAvailableThemes
 * GET: GroupV2.GetUserClanInviteSetting
 * POST: GroupV2.SetUserClanInviteSetting
 * POST: GroupV2.GetRecommendedGroups
 * POST: GroupV2.GroupSearch
 * POST: GroupV2.GetGroupByNameV2
 * GET: GroupV2.GetGroupOptionalConversations
 * POST: GroupV2.CreateGroup
 * POST: GroupV2.EditGroup
 * POST: GroupV2.EditClanBanner
 * POST: GroupV2.EditFounderOptions
 * POST: GroupV2.AddOptionalConversation
 * POST: GroupV2.EditOptionalConversation
 * POST: GroupV2.EditGroupMembership
 * POST: GroupV2.BanMember
 * POST: GroupV2.UnbanMember
 * POST: GroupV2.AbdicateFoundership
 * POST: GroupV2.RequestGroupMembership
 * POST: GroupV2.RescindGroupMembership
 * POST: GroupV2.ApproveAllPending
 * POST: GroupV2.DenyAllPending
 * POST: GroupV2.ApprovePendingForList
 * POST: GroupV2.DenyPendingForList Note: This is implemented but only accepts one member at a time
 * GET: GroupV2.GetGroupsForMember
 * GET: GroupV2.GetPotentialGroupsForMember
 *
 */
class Client
{
    /**
     * @var string Bungie API uri/host
     */
    protected $uri = "https://www.bungie.net/Platform";

    /**
     * @var string Destiny API Key
     */
    protected $apiKey;

    /**
     * @var string Destiny Application Client ID
     * @link https://www.bungie.net/en/Application/
     */
    protected $clientID;

    /**
     * @var string Destiny Application Client Secret (for confidential only)
     * @link https://www.bungie.net/en/Application/
     */
    protected $clientSecret;

    /**
     * @var string Destiny OAuth Token
     */
    protected $oauthToken;

    /**
     * @var HttpMethodsClient $httpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var bool Automatically retry the API call if it errors out?
     */
    protected $retryOnRateLimit = true;

    /**
     * @var int Number of times to re-attempt an API call
     */
    protected $maxReplyAttempts = 5;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $appName;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $appVersion;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $appIDNumber;

    /**
     * Used for User-Agent field
     * Do not include http:// or similar, ex. www.sample.net
     * @var string
     */
    protected $appURL;

    /**
     * Used for User-Agent field
     * @var string
     */
    protected $appEmail;

    /**
     * Client constructor.
     * @param string|null $apiKey If empty will attempt to read from the environmental variable APIKEY
     * @param string|null $token
     * @param string|null $clientID
     * @param string|null $clientSecret
     * @param string|null $appName
     * @param string|null $appVersion
     * @param string|null $appIDNumber
     * @param string|null $appURL
     * @param string|null $appEmail
     * @throws ApiKeyException
     */
    function __construct(?string $apiKey = null, ?string $token = null, ?string $clientID = null, ?string $clientSecret = null, ?string $appName = '', ?string $appVersion = '', ?string $appIDNumber = '', ?string $appURL = '', ?string $appEmail = '')
    {
        if (empty($apiKey)) {
            $apiKey = $_ENV["APIKEY"];
        }

        if (empty($apiKey)) {
            throw new ApiKeyException("API Key is not set");
        }

        $this->apiKey = $apiKey;

        if (!empty($token)) {
            $this->oauthToken = $token;
        }

        if (!empty($clientID)) {
            $this->clientID = $clientID;
        }

        if (!empty($clientSecret)) {
            $this->clientSecret = $clientSecret;
        }

        if (!empty($appName)) {
            $this->appName = $appName;
        }

        if (!empty($appVersion)) {
            $this->appVersion = $appVersion;
        }

        if (!empty($appIDNumber)) {
            $this->appIDNumber = $appIDNumber;
        }

        if (!empty($appURL)) {
            $this->appURL = $appURL;
        }

        if (!empty($appEmail)) {
            $this->appEmail = $appEmail;
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
     * @throws AuthException
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
            $response = $this->request($this->buildRequestString('GroupV2', [$group]));
        } else {
            $response = $this->request($this->buildRequestString('GroupV2', ['Name', $group, $groupType]));
        }
        return GroupResponse::makeFromArray($response['Response']);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array|null $extraParameters
     * @param int[]|null $allowedErrorCodes Some error codes are always a success (1). Some are always a failure (12, 2101). Some, like 699, are technically a success when called from certain endpoints.
     * @return mixed
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     * @throws AuthException
     */
    protected function request($url, string $method = 'GET', array $extraParameters = null, array $allowedErrorCodes = null)
    {
        $response = $this->internalRequest($url, $method, $extraParameters);

        $body = $this->convertResponseToArray($response);

        switch ($body['ErrorCode']) {
            case 1: // Success
                return $body;
                break;
            case 12: // INSUFFICIENTPRIVILEGES
                throw new AuthException($body['Message'], $body['ErrorCode'], $body['ThrottleSeconds'],
                    $body['ErrorStatus']);
                break;
            case 2101: // APIINVALIDOREXPIREDKEY
                throw new ApiKeyException($body['Message'], $body['ErrorCode'], $body['ThrottleSeconds'],
                    $body['ErrorStatus']);
                break;
            default:
                if (!empty($allowedErrorCodes)) {
                    if (in_array($body['ErrorCode'], $allowedErrorCodes)) {
                        return $body;
                    }
                }
                throw new ClientException($body['Message'], $body['ErrorCode'], $body['ThrottleSeconds'],
                    $body['ErrorStatus']);
                break;
        }
    }

    /**
     * @param string $url
     * @param string $method
     * @param array|null $body
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws Exception
     * @throws HttpClientException
     * @throws OAuthException
     */
    protected function internalRequest(string $url, string $method = 'GET', array $body = null)
    {

        if (empty($this->apiKey)) {
            throw new ApiKeyException("API Key is not set");
        }

        $method = strtoupper($method);
        if ($method != 'POST') {
            $method = 'GET';
        }

        $this->getHttpClient([], $this->httpClient, $this->messageFactory);

        try {
            $response = $this->httpClient->send($method, $url, [], json_encode($body));
        } catch (ClientErrorException $x) {
            switch ($x->getCode()) {
                case 401:
                    throw new OAuthException('401 Unauthorized', $x->getCode(), 0, '', $x);
                    break;
                case 405:
                    throw new ClientException('405 Method Not Allowed', $x->getCode(), 0, '', $x);
                    break;
                case 504:
                    throw new ClientException('504 Gateway Timeout', $x->getCode(), 0, '', $x);
                    break;
                default:
                    throw $x;
                    break;
            }
        }

        return $response;
    }

    /**
     * @param Plugin[] $plugins
     * @param HttpClient|null $httpClient
     * @param MessageFactory|null $messageFactory
     * @return HttpMethodsClient
     * @throws Exception
     */
    protected function getHttpClient(array $plugins = [], ?HttpClient $httpClient = null, ?MessageFactory $messageFactory = null): HttpMethodsClient
    {
        $userAgent = sprintf('%s/%s AppId/%s (+%s;%s)', $this->appName ?? '', $this->appVersion ?? '',
            $this->appIDNumber ?? '', $this->appURL ?? '', $this->appEmail ?? '');

        if (!$httpClient) {
            $httpClient = HttpClientDiscovery::find();
        }
        $plugins[] = new ContentTypePlugin();
        $plugins[] = new HeaderDefaultsPlugin([
            'User-Agent' => $userAgent,
            'X-Api-Key' => $this->apiKey
        ]);

        if (empty($this->uri)) {
            throw new Exception('Bungie API URI is not set.');
        }

        $plugins[] = new BaseUriPlugin(UriFactoryDiscovery::find()->createUri($this->uri));

        if (!empty($this->oauthToken)) {
            $authentication = new Bearer($this->oauthToken);
            $plugins[] = new AuthenticationPlugin($authentication);
        }

        if ($this->retryOnRateLimit) {
            $plugins[] = new RetryPlugin([
                'retries' => $this->maxReplyAttempts,
                'exception_decider' => $this->retryDecider(),
                'exception_delay' => $this->retryDelay()
            ]);
        }
        $plugins[] = new ErrorPlugin();

        $pluginClient = new PluginClient($httpClient, $plugins);

        if (!$messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        $this->httpClient = new HttpMethodsClient($pluginClient, $this->messageFactory);

        return $this->httpClient;
    }

    /**
     * Shim for testing the API by file
     *
     * @param string $responseFile
     * @param int $statusCode HTTP Response Code (Defaults to 200)
     * @param MessageFactory|null $messageFactory
     */
    public function setMock($responseFile, $statusCode = 200, ?MessageFactory $messageFactory = null)
    {
        $this->setupMock($messageFactory);

        $response = $this->messageFactory->createResponse($statusCode, 'REASON?', [], file_get_contents($responseFile));

        //$response = $this->creat
        $this->httpClient->addResponse($response);
//        $mock = new MockHandler([
//            new Response($statusCode, ['Content-Type' => 'application/json'], file_get_contents($responseFile))
//        ]);
//
//        $handler = HandlerStack::create($mock);
//        $this->httpClient = new GuzzleClient(['handler' => $handler]);
    }

    /**
     * Shim for testing the API by building a response
     *
     * @param string $responseFile
     * @param int $statusCode HTTP Response Code (Defaults to 200)
     * @param MessageFactory|null $messageFactory
     */
    public function buildMock($response, int $errorCode = 1, string $errorStatus = 'Success', int $throttleSeconds = 0, string $message = 'Ok', $messageData = null, $statusCode = 200, ?MessageFactory $messageFactory = null)
    {
        $this->setupMock($messageFactory);
        
        $body = json_encode([
            "Response" => $response,
          "ErrorCode" => $errorCode,
          "ThrottleSeconds" => $throttleSeconds,
          "ErrorStatus" => $errorStatus,
          "Message" => $message,
          "MessageData" => $messageData
        ]);

        $httpResponse = $this->messageFactory->createResponse($statusCode, 'REASON?', [], $body);

        $this->httpClient->addResponse($httpResponse);

    }

    /**
     * @param MessageFactory|null $messageFactory
     */
    protected function setupMock(MessageFactory $messageFactory = null)
    {
        if(empty($this->httpClient)) {
            $this->httpClient = new \Http\Mock\Client();
        }

        if (!$messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }        
    }

    /**
     * If we received error 429 (Rate limit) or 504 (Gateway timeout) try again
     * @return \Closure
     *
     * @todo Need to handle rate limits better, Bungie isn't returning 429 for rate limits
     */
    protected function retryDecider()
    {
        return function (
            RequestInterface $request,
            HttpClientException $exception = null
        ) {

            $response = $exception->getResponse();

            if (self::isAuthenticationError($response)) {
                return false;
            }
            if (self::isGatewayTimeout($response) || self::isRateLimit($response)) {
                return true;
            }
            if (!(self::isServerError($response))) {
                return false;
            }

            return true;
        };
    }

    /**
     * @param ResponseFactory|null $response
     * @return bool
     */
    protected static function isAuthenticationError($response = null)
    {
        return self::isResponseStatusCode($response, 401);
    }

    /**
     * @param ResponseFactory|null $response
     * @param int $statusCode
     * @return bool
     */
    protected static function isResponseStatusCode($response = null, int $statusCode = 0)
    {
        return $response && $response->getStatusCode() == $statusCode;

    }

    /**
     * @param ResponseFactory|null $response
     * @return bool
     */
    protected static function isGatewayTimeout($response = null)
    {
        return self::isResponseStatusCode($response, 504);
    }

    /**
     * @param ResponseFactory|null $response
     * @return bool
     *
     * @todo Need to handle rate limits better, Bungie isn't returning 429 for rate limits
     */
    protected static function isRateLimit($response = null)
    {
        return self::isResponseStatusCode($response, 429);
    }

    /**
     * @param ResponseFactory|null $response
     * @return bool
     */
    protected static function isServerError($response = null)
    {
        return $response && $response->getStatusCode() >= 500 && $response->getStatusCode() != 504;
    }

    /**
     * How long should we wait before retrying?
     *
     * @return \Closure The number of microseconds to wait before retrying
     *
     * @todo Properly handle the throttle seconds
     */
    protected function retryDelay()
    {
        return function (
            RequestInterface $request,
            HttpClientException $exception,
            int $numberOfRetries
        ) {
            $delay = 0;
            $response = $exception->getResponse();
            if (self::isGatewayTimeout($response)) {
                $delay = 5;
            }
            if (self::isRateLimit($response)) {
                $delay = 10;
            }
            if ($delay <= 0) {
                $delay = RetryPlugin::defaultDelay($request, $exception, $numberOfRetries);
            }
            return $delay * 1000000; // Delay is seconds and the function wants microseconds.
        };
    }

    /**
     * Helper function to convert the response into an array
     *
     * @param Response $response
     * @return mixed
     */
    public function convertResponseToArray(Response $response)
    {
        return json_decode($this->getResponseBody($response), true);
    }

    /**
     * Helper function to get the response body.
     *
     * @param Response $response
     * @return bool|string
     */
    public function getResponseBody(Response $response)
    {
        return $response->getBody()->getContents();
    }

    /**
     * @param string $endpoint
     * @param array|null $uriParams
     * @param array|null $queryParams
     * @return string
     */
    protected function buildRequestString($endpoint, array $uriParams = null, array $queryParams = null)
    {
        $query = '';
        if (!empty($queryParams)) {
            $query = http_build_query($queryParams);
        }
        $url = '';
        if (!empty($uriParams)) {
            $url = sprintf("%s/%s/%s/?%s", $this->uri, $endpoint, implode("/", $uriParams), $query);
        } else {
            $url = sprintf("%s/%s/?%s", $this->uri, $endpoint, $query);
        }
        $url = rtrim($url, '?');
        return $url;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Client
     */
    public function setUri(string $uri): Client
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Gets any active global alert for display in the forum banners, help pages, etc. Usually used for DOC alerts.
     *
     * @param bool $includeStreaming Determines whether Streaming Alerts are included in results
     * @return GlobalAlert[]|null
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_-GetGlobalAlerts.html#operation_get_-GetGlobalAlerts
     *
     * @todo Needs to support includeStreaming, currently ignores the parameter. We need valid output for when includestreaming returns something to write this properly. Also _buildRequestString converts the true/false to integers which Bungie will not accept.
     */
    public function getGlobalAlerts(bool $includeStreaming = false)
    {

        $includeStreaming = false;

        $queryParms = [];
        if ($includeStreaming) {
            $queryParms['includestreaming'] = $includeStreaming;
        }
        $response = $this->request($this->buildRequestString('GlobalAlerts', [],
            $queryParms));

        return array_map(function ($item) {
            return GlobalAlert::makeFromArray($item);
        }, $response['Response']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetMembersOfGroup.html#operation_get_GroupV2-GetMembersOfGroup
     */
    public function getClanMembers($clanID, $currentPage = 1)
    {
        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'Members'],
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
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetAdminsAndFounderOfGroup.html#operation_get_GroupV2-GetAdminsAndFounderOfGroup
     */
    public function getClanAdminsAndFounder($clanID, $currentPage = 1)
    {
        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'AdminsAndFounder'],
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
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetBannedMembersOfGroup.html#operation_get_GroupV2-GetBannedMembersOfGroup
     */
    public function getClanBannedMembers($clanID, $currentPage = 1)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'Banned'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMember[]
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetPendingMemberships.html#operation_get_GroupV2-GetPendingMemberships
     */
    public function getClanPendingMembers($clanID, $currentPage = 1)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'Members', 'Pending'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMember::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param $clanID
     * @param int $currentPage
     * @return GroupMemberApplication[]
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_get_GroupV2-GetInvitedIndividuals.html#operation_get_GroupV2-GetInvitedIndividuals
     */
    public function getClanInvitedMembers($clanID, $currentPage = 1)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'Members', 'InvitedIndividuals'],
            ['currentPage' => $currentPage]));

        return array_map(function ($item) {
            return GroupMemberApplication::makeFromArray($item);
        }, $response['Response']['results']);
    }

    /**
     * @param int $clanID
     * @param int|string $membershipType
     * @param int|string $membershipID
     * @return bool
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link
     */
    public function clanKickMember(int $clanID, $membershipType, $membershipID)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $response = $this->request($this->buildRequestString('GroupV2',
            [$clanID, 'Members', $membershipType, $membershipID, 'Kick']), 'POST');

        if ($response['ErrorCode'] === PlatformErrorCodes::SUCCESS) {
            return true;
        }

        throw new ClientException($response['Message'], $response['ErrorCode']);
    }

    /**
     * @param int $clanID
     * @param int|string $membershipType
     * @param int|string $membershipID
     * @return ClanApproveMember|null
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_post_GroupV2-ApprovePending.html#operation_post_GroupV2-ApprovePending
     */
    public function clanApproveMember(int $clanID, $membershipType, $membershipID)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $response = $this->request($this->buildRequestString('GroupV2',
            [$clanID, 'Members', 'Approve', $membershipType, $membershipID]), 'POST',
            [
                'message' => ''
            ], [PlatformErrorCodes::CLANAPPLICANTINCLANSONOWINVITED]);

        return new ClanApproveMember($clanID, $membershipType, $membershipID, $response['Response'], $response['ErrorCode'], $response['ErrorStatus'], $response['Message']);
    }

    /**
     * @param int $clanID
     * @param int|string $membershipType
     * @param int|string $membershipID
     * @param string $displayName
     * @return bool
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * @todo The return is currently broken. I believe it should simply be if ErrorCode == 1 then return true
     */
    public function clanDenyMember(int $clanID, $membershipType, $membershipID, string $displayName)
    {

        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }

        $member = new UserMembership($membershipType, $membershipID, $displayName);

        ///GroupV2/{groupId}/Members/DenyList/
        $response = $this->request($this->buildRequestString('GroupV2', [$clanID, 'Members', 'DenyList']), 'POST',
            [
                'memberships' => [json_decode(json_encode($member))],
                'message' => ''
            ]);

        if ($response['ErrorCode'] == PlatformErrorCodes::SUCCESS) {
            return true;
        } else {
            throw new ClientException($response['Message'], $response['ErrorCode'], $response['ThrottleSeconds'],
                $response['ErrorStatus']);
        }
    }

    /**
     * @param int $clanID
     * @param int|string $membershipType
     * @param int|string $membershipID
     * @return bool
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_post_GroupV2-IndividualGroupInvite.html#operation_post_GroupV2-IndividualGroupInvite
     */
    public function clanInviteMember(int $clanID, $membershipType, $membershipID)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $response = $this->request($this->buildRequestString('GroupV2',
            [$clanID, 'Members', 'IndividualInvite', $membershipType, $membershipID]), 'POST',
            [
                'message' => ''
            ]);

        if ($response['ErrorStatus'] == "Success") {
            return true;
        } else {
            throw new ClientException($response['Message'], $response['ErrorCode'], $response['ThrottleSeconds'],
                $response['ErrorStatus']);
        }
    }

    /**
     * @param int $clanID
     * @param int|string $membershipType
     * @param int|string $membershipID
     * @return bool
     *
     * @throws ApiKeyException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     *
     * @link https://bungie-net.github.io/multi/operation_post_GroupV2-IndividualGroupInviteCancel.html#operation_post_GroupV2-IndividualGroupInviteCancel
     */
    public function clanInviteMemberCancel(int $clanID, $membershipType, $membershipID)
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $response = $this->request($this->buildRequestString('GroupV2',
            [$clanID, 'Members', 'IndividualInviteCancel', $membershipType, $membershipID]), 'POST');

        if ($response['ErrorStatus'] == "Success") {
            if ($response['Response']['resolution'] == 3) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new ClientException($response['Message'], $response['ErrorCode'], $response['ThrottleSeconds'],
                $response['ErrorStatus']);
        }
    }

    /**
     * @return GeneralUser
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * Requires an OAuth token
     */
    public function getCurrentBungieUser()
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }
        $response = $this->request($this->buildRequestString('User', ['GetCurrentBungieNetUser']));

        return GeneralUser::makeFromArray($response['Response']);
    }

    /**
     * @param int|string $membershipType
     * @param int $membershipID
     * @param string[]|int[] ...$components
     *
     * @return mixed
     *
     * @throws ApiKeyException
     * @throws AuthException
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

        $response = $this->request($this->buildRequestString('Destiny2', [$membershipType, 'Profile', $membershipID],
            ['components' => implode(',', $params)]));

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
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getMobileWorldContentsPath($locale = "en")
    {
        $response = $this->request($this->buildRequestString('Destiny2', ['Manifest']));

        return $response['Response']['mobileWorldContentPaths'][$locale];
    }

    /**
     * @param int $userID
     * @return GeneralUser
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_User-GetBungieNetUserById.html#operation_get_User-GetBungieNetUserById
     */
    public function getBungieUser($userID)
    {
        $response = $this->request($this->buildRequestString('User', ['GetBungieNetUserById', $userID]));

        return GeneralUser::makeFromArray($response['Response']);
    }

    /**
     * @return array
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getMembershipDataForCurrentUser()
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
        }
        $response = $this->request($this->buildRequestString('User', ['GetMembershipsForCurrentUser']));

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
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getBungieAccount($membershipType, $membershipID)
    {
        $response = $this->request($this->buildRequestString('User',
            ['GetBungieAccount', $membershipID, $membershipType]));

        return $response;

    }

    /**
     * @param int|string $membershipType
     * @param int $membershipID
     * @return mixed
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     */
    public function getGroupV2User($membershipType, $membershipID)
    {
        $response = $this->request($this->buildRequestString('GroupV2',
            ['User', $membershipType, $membershipID, 0, 1]));

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
     * @throws AuthException
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
    public function getVendor(
        $membershipType,
        string $membershipID,
        string $characterID,
        ?string $vendor = null,
        ...$components
    )
    {
        if (empty($this->oauthToken)) {
            throw new OAuthException();
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

        if (!self::validateComponents($params, [
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
        $response = $this->request($this->buildRequestString('Destiny2', $uriParams,
            ['components' => implode(',', $params)]));

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
     * @param string[]|int[] $components
     * @param string[]|int[] $allowedComponents
     * @return bool
     */
    protected static function validateComponents(array $components, array $allowedComponents): bool
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
     * @param int $userID
     * @return PublicPartnershipDetail
     *
     * @throws ApiKeyException
     * @throws AuthException
     * @throws ClientException
     * @throws OAuthException
     *
     * @link https://bungie-net.github.io/multi/operation_get_User-GetPartnerships.html#operation_get_User-GetPartnerships
     */
    public function getPartnerships($userID)
    {
        $response = $this->request($this->buildRequestString('User', [$userID, 'Partnerships']));

        if (empty($response['Response'])) {
            throw new ClientException('No results found');
        }
        return PublicPartnershipDetail::makeFromArray($response['Response'][0]);
    }

    /**
     * @return null|string
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param null|string $apiKey
     * @return Client
     */
    public function setApiKey(?string $apiKey): Client
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientID(): ?string
    {
        return $this->clientID;
    }

    /**
     * @param null|string $clientID
     * @return Client
     */
    public function setClientID(?string $clientID): Client
    {
        $this->clientID = $clientID;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param null|string $clientSecret
     * @return Client
     */
    public function setClientSecret(?string $clientSecret): Client
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOauthToken(): ?string
    {
        return $this->oauthToken;
    }

    /**
     * @param null|string $oauthToken
     * @return Client
     */
    public function setOauthToken(?string $oauthToken): Client
    {
        $this->oauthToken = $oauthToken;
        return $this;
    }

    /**
     * @return bool
     */
    public function getRetryOnRateLimit(): bool
    {
        return $this->retryOnRateLimit;
    }

    /**
     * @param bool $retryOnRateLimit
     * @return Client
     */
    public function setRetryOnRateLimit(bool $retryOnRateLimit = true): Client
    {
        $this->retryOnRateLimit = $retryOnRateLimit;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxReplyAttempts(): int
    {
        return $this->maxReplyAttempts;
    }

    /**
     * @param int $maxReplyAttempts
     * @return Client
     */
    public function setMaxReplyAttempts(int $maxReplyAttempts = 5): Client
    {
        if (empty($maxReplyAttempts) || $maxReplyAttempts < 1) {
            $maxReplyAttempts = 1;
        }
        $this->maxReplyAttempts = $maxReplyAttempts;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppName(): string
    {
        return $this->appName ?? '';
    }

    /**
     * @param string $appName
     * @return Client
     */
    public function setAppName(string $appName): Client
    {
        $this->appName = $appName ?? '';
        return $this;
    }

    /**
     * @return string
     */
    public function getAppVersion(): string
    {
        return $this->appVersion ?? '';
    }

    /**
     * @param string $appVersion
     * @return Client
     */
    public function setAppVersion(string $appVersion): Client
    {
        $this->appVersion = $appVersion ?? '';
        return $this;
    }

    /**
     * @return string
     */
    public function getAppIDNumber(): string
    {
        return $this->appIDNumber ?? '';
    }

    /**
     * @param string $appIDNumber
     * @return Client
     */
    public function setAppIDNumber(string $appIDNumber): Client
    {
        $this->appIDNumber = $appIDNumber ?? '';
        return $this;
    }

    /**
     * @return string
     */
    public function getAppURL(): string
    {
        return $this->appURL ?? '';
    }

    /**
     * @param string $appURL
     * @return Client
     */
    public function setAppURL(string $appURL): Client
    {
        $this->appURL = $appURL ?? '';
        return $this;
    }

    /**
     * @return string
     */
    public function getAppEmail(): string
    {
        return $this->appEmail ?? '';
    }

    /**
     * @param string $appEmail
     * @return Client
     */
    public function setAppEmail(string $appEmail): Client
    {
        $this->appEmail = $appEmail ?? '';
        return $this;
    }
}
