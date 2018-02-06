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
 * Class DestinyItemQuantity
 * @package Destiny\Objects
 *
 * @method string itemHash() The hash identifier for the item in question. Use it to look up the item's DestinyInventoryItemDefinition.
 * @method string itemInstanceId() If this quantity is referring to a specific instance of an item, this will have the item's instance ID. Normally, this will be null.
 * @method int quantity() The amount of the item needed/available depending on the context of where DestinyItemQuantity is being used.
 */
class DestinyItemQuantity extends AbstractResource //implements JsonSerializable
{

}