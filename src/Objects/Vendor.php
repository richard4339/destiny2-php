<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Objects;


use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class Vendor
 * @package Destiny\Objects
 *
 * @method int vendorHash()
 * @method \DateTime nextRefreshDate($tz = null)
 * @method boolean enabled()
 * @method boolean canPurchase()
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-Entities-Vendors-DestinyVendorComponent.html#schema_Destiny-Entities-Vendors-DestinyVendorComponent
 */
class Vendor extends AbstractResource implements JsonSerializable
{

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     */
    protected $dates = [
        'nextRefreshDate',
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'vendorHash' => $this->vendorHash(),
            'nextRefreshDate' => $this->nextRefreshDate(),
            'enabled' => $this->enabled(),
            'canPurchase' => $this->canPurchase(),
        ];
    }
}