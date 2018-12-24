<?php

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\RuntimeGroupMemberApplicationType;
use JsonSerializable;

/**
 * Class GroupMemberApplication
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupMemberApplication.html#schema_GroupsV2-GroupMemberApplication
 *
 * @method string groupId()
 * @method \DateTime creationDate($tz = null)
 * @method int resolveState()
 * @method UserInfoCard destinyUserInfo()
 * @method UserInfoCard bungieNetUserInfo()
 *
 * @todo According to the API, both destinyUserInfo() and bungieNetUserInfo() return a UserInfoCard,
 * however, they actually return slightly different data. The bungieNetUserInfo() returns a membershipType that isn't
 * defined for example
 */
class GroupMemberApplication extends AbstractResource implements JsonSerializable
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
        'creationDate'
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $return = [
            'groupId' => $this->groupId(),
            'creationDate' => $this->creationDate(),
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