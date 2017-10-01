<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-10-01 12:32 CDT by richard
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;

/**
 * Class ClanInfoAndInvestment
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupV2ClanInfoAndInvestment.html#schema_GroupsV2-GroupV2ClanInfoAndInvestment
 *
 * @method mixed d2ClanProgressions()
 * @method string clanCallSign()
 * @method ClanBanner clanBannerData()
 *
 * @todo d2ClanProgressions() uses the manifests and needs to be handled
 */
class ClanInfoAndInvestment extends AbstractResource
{
    /**
     * @var array
     */
    protected $casts = [
        'clanBannerData' => ClanBanner::class
    ];

}