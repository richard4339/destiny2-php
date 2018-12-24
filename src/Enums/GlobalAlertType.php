<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2018-12-07 09:56 CST by richard
 *
 */

namespace Destiny\Enums;

/**
 * Class GlobalAlertType
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_GlobalAlertType.html#schema_GlobalAlertType
 */
class GlobalAlertType implements Enum
{

    /**
     *
     */
    const GLOBALALERT = 0;

    /**
     *
     */
    const STREAMINGALERT = 1;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::GLOBALALERT:
                return "GlobalAlert";
                break;
            case self::STREAMINGALERT:
                return "StreamingAlert";
                break;
            default:
                return '';
                break;
        }
    }
}