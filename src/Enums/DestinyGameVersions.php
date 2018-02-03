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
 * Class DestinyGameVersions
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-DestinyGameVersions.html#schema_Destiny-DestinyGameVersions
 */
class DestinyGameVersions implements Enum
{

    /**
     * None
     */
    const NONE = 0;

    /**
     * Destiny 2 (Vanilla)
     */
    const DESTINY2 = 1;

    /**
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::NONE:
                return "None";
                break;
            case self::DESTINY2:
                return "Destiny2";
                break;
            default:
                return "";
                break;
        }
    }

}