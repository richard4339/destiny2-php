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
 * Class VendorSale
 * @package Destiny\Objects
 *
 * @method int vendorItemIndex()
 * @method string itemHash()
 * @method int quantity()
 * @method int saleStatus()
 *
 * @todo Sale status enum https://bungie-net.github.io/multi/schema_Destiny-VendorItemStatus.html#schema_Destiny-VendorItemStatus
 */
class VendorSale extends AbstractResource //implements JsonSerializable
{

    /**
     * Gets the cost values
     *
     * @return VendorSaleCost[]
     */
    public function costs()
    {
        return array_map(function ($item) {
            return VendorSaleCost::makeFromArray($item);
        }, $this->get('costs'));
    }

}