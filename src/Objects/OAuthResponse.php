<?php

namespace Destiny\Objects;

use Destiny\AbstractResource;

/**
 * Class OAuthResponse
 * @package Destiny\Objects
 *
 * This class defines the data coming from a Bungie OAuth authentication call.
 * The calling methods are not included in this library at this time.
 *
 * @link https://github.com/Bungie-net/api/wiki/OAuth-Documentation
 *
 * @method string access_token()
 * @method string token_type()
 * @method int expires_in()
 * @method string refresh_token()
 * @method int refresh_expires_in()
 * @method string membership_id()
 */
class OAuthResponse extends AbstractResource
{
}