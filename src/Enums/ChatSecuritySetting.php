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
 * Class ChatSecuritySetting
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-ChatSecuritySetting.html#schema_GroupsV2-ChatSecuritySetting
 */
class ChatSecuritySetting implements Enum
{

    /**
     *
     */
    const GROUP = 0;

    /**
     *
     */
    const ADMINS = 1;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::GROUP:
                return "Group";
                break;
            case self::ADMINS:
                return "Admins";
                break;
            default:
                return '';
                break;
        }
    }
}