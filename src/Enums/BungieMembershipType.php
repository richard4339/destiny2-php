<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Enums;

/**
 * Class BungieMembershipType
 * @package Destiny\Enums
 */
class BungieMembershipType implements Enum
{
    /**
     *
     */
    const ALL = -1;

    /**
     *
     */
    const NONE = 0;

    /**
     *
     */
    const TIGERXBOX = 1;

    /**
     *
     */
    const TIGERPSN = 2;

    /**
     *
     */
    const TIGERBLIZZARD = 4;

    /**
     *
     */
    const TIGERDEMON = 10;

    /**
     * Actual Bungie account
     */
    const BUNGIENEXT = 254;

    /**
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::ALL:
                return "All";
                break;
            case self::NONE:
                return "None";
                break;
            case self::TIGERXBOX:
                return "TigerXBox";
                break;
            case self::TIGERPSN:
                return "TigerPSN";
                break;
            case self::TIGERBLIZZARD:
                return "TigerBlizzard";
                break;
            case self::TIGERDEMON:
                return "TigerDemon";
                break;
            case self::BUNGIENEXT:
                return "BungieNext";
                break;
            default:
                return "";
                break;
        }
    }

}