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
use Destiny\Enums\RuntimeGroupMemberType;
use JsonSerializable;

/**
 * Class GroupMember
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupMember.html#schema_GroupsV2-GroupMember
 *
 * @method int memberType() RuntimeGroupMemberType enum
 * @method bool isOnline()
 * @method string groupId()
 * @method \DateTime joinDate($tz = null)
 * @method UserInfoCard destinyUserInfo()
 * @method UserInfoCard bungieNetUserInfo()
 *
 * @todo According to the API, both destinyUserInfo() and bungieNetUserInfo() return a UserInfoCard,
 * however, they actually return slightly different data. The bungieNetUserInfo() returns a membershipType that isn't
 * defined for example
 */
class GroupMember extends AbstractResource implements JsonSerializable
{

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'destinyUserInfo' => UserInfoCard::class,
        'bungieNetUserInfo' => UserInfoCard::class
    ];

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     * @deprecated 0.3.0
     */
    protected $dates = [
        'joinDate'
    ];

    /**
     * Gets the member type label
     *
     * @return string
     */
    public function memberTypeLabel()
    {
        return RuntimeGroupMemberType::getLabel($this->memberType());
    }

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $return = [
            'memberType' => $this->memberType(),
            'isOnline' => $this->isOnline(),
            'groupId' => $this->groupId(),
            'joinDate' => $this->joinDate(),
            'destinyUserInfo' => $this->destinyUserInfo(),
        ];

        try {
            $return['bungieDisplayName'] = $this->bungieNetUserInfo()->displayName();
            $return['bungieNetUserInfo'] = $this->bungieNetUserInfo();
        } catch (\Throwable $x) {
            $return['bungieDisplayName'] = '';
            $return['bungieNetUserInfo'] = null;
        }

        return $return;
    }

}