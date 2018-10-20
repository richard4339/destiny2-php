# destiny2-php
A PHP wrapper for the [Destiny 2 API](https://github.com/Bungie-net/api)

[![Latest Stable Version](https://poser.pugx.org/richard4339/destiny2-php/v/stable)](https://packagist.org/packages/richard4339/destiny2-php)
[![Total Downloads](https://poser.pugx.org/richard4339/destiny2-php/downloads)](https://packagist.org/packages/richard4339/destiny2-php)
[![Latest Unstable Version](https://poser.pugx.org/richard4339/destiny2-php/v/unstable)](https://packagist.org/packages/richard4339/destiny2-php)
[![License](https://poser.pugx.org/richard4339/destiny2-php/license)](https://packagist.org/packages/richard4339/destiny2-php)
[![composer.lock](https://poser.pugx.org/richard4339/destiny2-php/composerlock)](https://packagist.org/packages/richard4339/destiny2-php)
[![Build Status](https://travis-ci.org/richard4339/destiny2-php.svg?branch=master)](https://travis-ci.org/richard4339/destiny2-php)

## About
Currently includes (mostly) just the clan endpoints, with user endpoints coming soon. Basic vendor support has been added as well (Xur's hash is ```2190858386``` FYI).

My intention is to make all object calls be JSON Serializable by implementing JsonSerializable()

## Installation
### Using Composer
```
composer require richard4339/destiny2-php
```

## Usage
```
require 'vendor/autoload.php';

$client = new \Destiny\Client('[YOUR API KEY]', '[OPTIONAL OAUTH TOKEN]', '[OPTIONAL CLIENT ID]', '[OPTIONAL CLIENT SECRET]', '[OPTIONAL YOUR APP NAME]', '[OPTIONAL YOUR APP VERSION]', '[OPTIONAL YOUR APP ID]', '[OPTIONAL YOUR APP URL]', '[OPTIONAL YOUR APP EMAIL]');
  
$clan = $client->getGroup(12345);
  
try {
    $whoami = $client->getBungieUser(9999999999);
} catch (\Destiny\Exceptions\ClientException $x) {
    
}
  
$members = $client->getClanAdminsAndFounder(12345);
```
The optional App Name, Version, ID, URL, and Email fields were added to populate the User-Agent in the header, [which is now recommended by Bungie (and may eventually be required)](https://github.com/Bungie-net/api#are-there-any-restrictions-on-the-api).

### Symfony
If you want to use this in a Symfony project, the code below can be used to wire the service in `services.yaml` for calls that do not require OAuth:
```
services:
    Destiny\Client:
        arguments:
            $apiKey: '%destiny.api_key%'
            $appName: '[YOUR APP NAME]'
            $appVersion: '[YOUR APP VERSION]'
            $appIDNumber: '[YOUR APP ID]'
            $appURL: '[YOUR APP URL]'
            $appEmail: '[YOUR EMAIL]'
```
Replace `[YOUR APP NAME]`, `[YOUR APP VERSION]`, `[YOUR APP ID]`, `[YOUR APP URL]`, and `[YOUR EMAIL]`.

It also assumes you have defined your API key defined in your `services.yaml` as well:
```
parameters:
    destiny.client_id: '%env(DESTINY_CLIENT_ID)%'
    destiny.client_secret: '%env(DESTINY_CLIENT_SECRET)%'
    destiny.api_key: '%env(DESTINY_API_KEY)%'
```

For calls that require OAuth, you need to extend `Client` and wire your token in. The code below is just an example that works using the Security component which can get the token from the User.

```
<?php

namespace App\Services;


use Destiny\Client;
use Symfony\Component\Security\Core\Security;


/**
 * Class BungieOAuthRequest
 * @package App\Services
 */
class BungieOAuthRequest extends Client
{

    /**
     * BungieOAuthRequest constructor.
     * @param Security $security
     * @param string $apiKey
     * @param null|string $clientID
     * @param null|string $clientSecret
     * @param null|string $appName
     * @param null|string $appVersion
     * @param null|string $appIDNumber
     * @param null|string $appURL
     * @param null|string $appEmail
     * @throws \Destiny\Exceptions\ApiKeyException
     */
    public function __construct(Security $security, string $apiKey = '', ?string $clientID = null, ?string $clientSecret = null, ?string $appName = '', ?string $appVersion = '', ?string $appIDNumber = '', ?string $appURL = '', ?string $appEmail = '')
    {
        $user = $security->getUser();

        $token = $user->getBungieAccessToken();
        parent::__construct($apiKey, $token, $clientID, $clientSecret, $appName, $appVersion, $appIDNumber, $appURL, $appEmail);
    }
}
```

`services.yaml` wiring:
```
services:
    App\Services\BungieOAuthRequest:
        arguments:
            $security: '@security.helper'
            $apiKey: '%destiny.api_key%'
            $clientID: '%destiny.client_id%'
            $clientSecret: '%destiny.client_secret%'
            $appName: '[YOUR APP NAME]'
            $appVersion: '[YOUR APP VERSION]'
            $appIDNumber: '[YOUR APP ID]'
            $appURL: '[YOUR APP URL]'
            $appEmail: '[YOUR EMAIL]'
```

## Requirements
- Uses the GuzzleHTTP package
- Requires PHP 7.1
- Bungie API Key ([get that here](https://www.bungie.net/en/Application))
- For some calls, an [OAuth token](https://github.com/Bungie-net/api/wiki/OAuth-Documentation)

## Destiny API Resources
If you need assistance with the Destiny API, there are a bunch of great resources maintained by a few wonderful community members!
- [Destiny Devs Wiki](https://destinydevs.github.io/BungieNetPlatform/)
- [Destiny API Wiki](https://github.com/vpzed/Destiny2-API-Info/wiki)
- [Destiny 2 API](https://github.com/Bungie-net/api)
- [Manifest 101](https://gist.github.com/vpzed/94fc67ddb16c6d2e0494fda4ce6c9a3d)
- [List of Projects](https://gist.github.com/vpzed/2e950d3a00c3539e242f7eb7b4b07288)
- [Destiny.Plumbing](https://destiny.plumbing)