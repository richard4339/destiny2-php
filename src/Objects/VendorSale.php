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
use Destiny\Enums\VendorItemStatus;
use JsonSerializable;

/**
 * Class VendorSale
 * @package Destiny\Objects
 *
 * @method int vendorItemIndex()
 * @method string itemHash()
 * @method int quantity()
 * @method int saleStatus() VendorItemStatus enum
 * @method DestinyItemQuantity[] costs()
 */
class VendorSale extends AbstractResource implements JsonSerializable
{

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $arrays = [
        'costs' => DestinyItemQuantity::class,
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'vendorItemIndex' => $this->vendorItemIndex(),
            'itemHash' => $this->itemHash(),
            'quantity' => $this->quantity(),
            'saleStatus' => $this->saleStatus(),
            'saleStatusLabel' => VendorItemStatus::getLabel($this->saleStatus()),
            'costs' => $this->costs(),
        ];
    }

}