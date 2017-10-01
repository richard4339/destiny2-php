<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-30 13:02 CDT by richard
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

    const GENERAL = 0;
    const CLAN = 1;

    /**
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