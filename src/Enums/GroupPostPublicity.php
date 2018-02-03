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
 * Class GroupPostPublicity
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupPostPublicity.html#schema_GroupsV2-GroupPostPublicity
 */
class GroupPostPublicity implements Enum
{
    /**
     *
     */
    const PUBLICITY_PUBLIC = 0;

    /**
     *
     */
    const PUBLICITY_ALLIANCE = 1;

    /**
     *
     */
    const PUBLICITY_PRIVATE = 2;

    /**
     * Get the label for the provided enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::PUBLICITY_PUBLIC:
                return "Public";
                break;
            case self::PUBLICITY_ALLIANCE:
                return "Alliance";
                break;
            case self::PUBLICITY_PRIVATE:
                return "Private";
                break;
            default:
                return '';
                break;
        }
    }

}