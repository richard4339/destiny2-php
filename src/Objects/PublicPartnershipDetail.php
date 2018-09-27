<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\BungieMembershipType;
use JsonSerializable;

/**
 * Class PublicPartnershipDetail
 * All the partnership info that's fit to expose externally, if we care to do so.
 *
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_Partnerships-PublicPartnershipDetail.html#schema_Partnerships-PublicPartnershipDetail
 *
 * @method int partnerType() See: Partnerships.PartnershipType
 * @method string identifier()
 * @method string name()
 * @method string icon()
 *
 */
class PublicPartnershipDetail extends AbstractResource implements JsonSerializable
{

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'partnerType' => $this->partnerType(),
            'identifier' => $this->identifier(),
            'name' => $this->name(),
            'icon' => $this->icon(),
        ];
    }

}