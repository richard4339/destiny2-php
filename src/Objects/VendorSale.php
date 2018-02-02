<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.2.1
 *
 * Built 2018-02-02 19:18 CST by richard
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
     * @return VendorSaleCost[]
     */
    public function costs()
    {
        return array_map(function ($item) {
            return VendorSaleCost::makeFromArray($item);
        }, $this->get('costs'));
    }

}