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
 * Class VendorItemStatus
 * @package Destiny\Enums
 */
class VendorItemStatus
{
    /**
     *
     */
    const SUCCESS = 0;

    /**
     *
     */
    const NOINVENTORYSPACE = 1;

    /**
     *
     */
    const NOFUNDS = 2;

    /**
     *
     */
    const NOPROGRESSION = 4;

    /**
     *
     */
    const NOUNLOCK = 8;

    /**
     *
     */
    const NOQUANTITY = 16;

    /**
     *
     */
    const OUTSIDEPURCHASEWINDOW = 32;

    /**
     *
     */
    const NOTAVAILABLE = 64;

    /**
     *
     */
    const UNIQUENESSVIOLATION = 128;

    /**
     *
     */
    const UNKNOWNERROR = 256;

    /**
     *
     */
    const ALREADYSELLING = 512;

    /**
     *
     */
    const UNSELLABLE = 1024;

    /**
     *
     */
    const SELLINGINHIBITED = 2048;

    /**
     *
     */
    const ALREADYOWNED = 4096;


    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::SUCCESS:
                return "Success";
                break;
            case self::NOINVENTORYSPACE:
                return "NoInventorySpace";
                break;
            case self::NOFUNDS:
                return "NoFunds";
                break;
            case self::NOPROGRESSION:
                return "NoProgression";
                break;
            case self::NOUNLOCK:
                return "NoUnlock";
                break;
            case self::NOQUANTITY:
                return "NoQuantity";
                break;
            case self::OUTSIDEPURCHASEWINDOW:
                return "OutsidePurchaseWindow";
                break;
            case self::NOTAVAILABLE:
                return "NotAvailable";
                break;
            case self::UNIQUENESSVIOLATION:
                return "UniquenessViolation";
                break;
            case self::UNKNOWNERROR:
                return "UnknownError";
                break;
            case self::ALREADYSELLING:
                return "AlreadySelling";
                break;
            case self::UNSELLABLE:
                return "Unsellable";
                break;
            case self::SELLINGINHIBITED:
                return "SellingInhibited";
                break;
            case self::ALREADYOWNED:
                return "AlreadyOwned";
                break;
            default:
                return "";
                break;
        }
    }

}