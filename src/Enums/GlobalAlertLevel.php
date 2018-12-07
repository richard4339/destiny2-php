<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2018-12-07 09:48 CST by richard
 *
 */

namespace Destiny\Enums;

/**
 * Class GlobalAlertLevel
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GlobalAlertLevel.html#schema_GlobalAlertLevel
 */
class GlobalAlertLevel implements Enum
{

    /**
     *
     */
    const UNKNOWN = 0;

    /**
     *
     */
    const BLUE = 1;

    /**
     *
     */
    const YELLOW = 2;

    /**
     *
     */
    const RED = 3;

    /**
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::UNKNOWN:
                return "Unknown";
                break;
            case self::BLUE:
                return "Blue";
                break;
            case self::YELLOW:
                return "Yellow";
                break;
            case self::RED:
                return "Red";
                break;
            default:
                return '';
                break;
        }
    }
}