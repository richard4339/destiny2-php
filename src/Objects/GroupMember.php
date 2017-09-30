<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-23 10:25 CDT by richard
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\RuntimeGroupMemberType;
use JsonSerializable;

/**
 * Class GroupMember
 * @package Destiny\Objects
 *
 * @method int memberType()
 * @method bool isOnline()
 * @method string groupId()
 * @method string joinDate()
 * @method DestinyUserInfo destinyUserInfo()
 * @method BungieNetUserInfo bungieNetUserInfo()
 */
class GroupMember extends AbstractResource
{

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'destinyUserInfo' => DestinyUserInfo::class,
        'bungieNetUserInfo' => BungieNetUserInfo::class
    ];

    /**
     * @return string
     */
    public function memberTypeLabel() {
        return RuntimeGroupMemberType::getLabel($this->memberType());
    }

}