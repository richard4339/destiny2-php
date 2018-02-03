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
 * Class MembershipOption
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-MembershipOption.html#schema_GroupsV2-MembershipOption
 */
class MembershipOption implements Enum
{
    /**
     *
     */
    const REVIEWED = 0;

    /**
     *
     */
    const OPEN = 1;

    /**
     *
     */
    const CLOSED = 2;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::REVIEWED:
                return "Reviewed";
                break;
            case self::OPEN:
                return "Open";
                break;
            case self::CLOSED:
                return "Closed";
                break;
            default:
                return "";
                break;
        }
    }

}