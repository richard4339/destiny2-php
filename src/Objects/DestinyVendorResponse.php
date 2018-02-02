<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.2
 *
 * Built 2018-02-02 19:18 CST by richard
 *
 */

namespace Destiny\Objects;


use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class DestinyVendorResponse
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-Responses-DestinyVendorResponse.html#schema_Destiny-Responses-DestinyVendorResponse
 *
 * @method Vendor vendor() Requires OAuth
 * @method VendorCategory[]|VendorCategory categories() Requires OAuth
 * @method VendorSale[]|VendorSale sales() Requires OAuth
 *
 * @property Vendor $vendor
 *
 */
class DestinyVendorResponse extends AbstractResource //implements JsonSerializable
{

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'vendor' => Vendor::class,
        'categories' => VendorCategory::class,
        'sales' => VendorSale::class,
    ];

}