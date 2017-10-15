<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-10-15 0:01 CDT by richard
 *
 */

namespace Destiny\Enums;

/**
 * Class Capabilities
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-Capabilities.html#schema_GroupsV2-Capabilities
 */
class Capabilities implements Enum
{

    /**
     *
     */
    const NONE = 0;

    /**
     *
     */
    const LEADERBOARDS = 1;

    /**
     *
     */
    const CALLSIGN = 2;

    /**
     *
     */
    const OPTIONALCONVERSATIONS = 4;

    /**
     *
     */
    const CLANBANNER = 8;

    /**
     *
     */
    const D2INVESTMENTDATA = 16;

    /**
     *
     */
    const TAGS = 32;

    /**
     *
     */
    const ALLIANCES = 64;

    /**
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::NONE:
                return "None";
                break;
            case self::LEADERBOARDS:
                return "Leaderboards";
                break;
            case self::CALLSIGN:
                return "Callsign";
                break;
            case self::OPTIONALCONVERSATIONS:
                return "OptionalConversations";
                break;
            case self::CLANBANNER:
                return "ClanBanner";
                break;
            case self::D2INVESTMENTDATA:
                return "D2InvestmentData";
                break;
            case self::TAGS:
                return "Tags";
                break;
            case self::ALLIANCES:
                return "Alliances";
                break;
            default:
                return "";
                break;
        }
    }

}