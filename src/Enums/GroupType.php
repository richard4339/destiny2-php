<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 *
 */

namespace Destiny\Enums;

/**
 * Class GroupType
 * @package Destiny\Enums
 */
class GroupType implements Enum
{

    /**
     *
     */
    const GENERAL = 0;

    /**
     *
     */
    const CLAN = 1;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::GENERAL:
                return "General";
                break;
            case self::CLAN:
                return "Clan";
                break;
            default:
                return "";
                break;
        }
    }

}