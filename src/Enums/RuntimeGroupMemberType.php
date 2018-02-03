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
 * Class RuntimeGroupMemberType
 * @package Destiny\Enums
 */
class RuntimeGroupMemberType implements Enum
{

    const NONE = 0;
    const BEGINNER = 1;
    const MEMBER = 2;
    const ADMIN = 3;
    const ACTINGFOUNDER = 4;
    const FOUNDER = 5;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type) {
        switch ($type) {
            case self::NONE:
                return "None";
                break;
            case self::BEGINNER:
                return "Beginner";
                break;
            case self::MEMBER:
                return "Member";
                break;
            case self::ADMIN:
                return "Admin";
                break;
            case self::ACTINGFOUNDER:
                return "ActingFounder";
                break;
            case self::FOUNDER:
                return "Founder";
                break;
            default:
                return '';
                break;
        }
    }

}