# destiny2-php
A PHP wrapper for the [Destiny 2 API](https://github.com/Bungie-net/api)

[![Latest Stable Version](https://poser.pugx.org/richard4339/destiny2-php/v/stable)](https://packagist.org/packages/richard4339/destiny2-php)
[![Total Downloads](https://poser.pugx.org/richard4339/destiny2-php/downloads)](https://packagist.org/packages/richard4339/destiny2-php)
[![Latest Unstable Version](https://poser.pugx.org/richard4339/destiny2-php/v/unstable)](https://packagist.org/packages/richard4339/destiny2-php)
[![License](https://poser.pugx.org/richard4339/destiny2-php/license)](https://packagist.org/packages/richard4339/destiny2-php)
[![composer.lock](https://poser.pugx.org/richard4339/destiny2-php/composerlock)](https://packagist.org/packages/richard4339/destiny2-php)
[![Build Status](https://travis-ci.org/richard4339/destiny2-php.svg?branch=master)](https://travis-ci.org/richard4339/destiny2-php)

## About
Currently includes (mostly) just the clan endpoints, with user endpoints coming soon.

My intention is to make all object calls be JSON Serializable by implementing JsonSerializable()

## Installation
### Using Composer
```
composer require richard4339/destiny2-php
```

## Usage
```
$client = new \Destiny\Client('[YOUR API KEY', 'OPTIONAL OAUTH TOKEN');
  
$clan = $client->getGroup(12345);
  
try {
    $whoami = $client->getBungieUser(9999999999);
} catch (\Destiny\Exceptions\ClientException $x) {
    
}
  
$members = $client->getClanAdminsAndFounder(12345);
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