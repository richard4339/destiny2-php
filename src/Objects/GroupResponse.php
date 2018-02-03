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
use JsonSerializable;

/**
 * Class GroupResponse
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupResponse.html#schema_GroupsV2-GroupResponse
 *
 * @method Group detail()
 * @method GroupMember founder()
 * @method int[] alliedIds()
 * @method Group parentGroup()
 * @method int allianceStatus() GroupAllianceStatus enum https://bungie-net.github.io/multi/schema_GroupsV2-GroupAllianceStatus.html#schema_GroupsV2-GroupAllianceStatus
 * @method int groupJoinInviteCount()
 * @method mixed currentUserMemberMap() Requires OAuth
 * @method mixed currentUserPotentialMemberMap() Requires OAuth
 *
 */
class GroupResponse extends AbstractResource implements JsonSerializable
{

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'detail' => Group::class,
        'founder' => GroupMember::class,
        'parentGroup' => Group::class,
//        'currentUserMemberMap' => GroupMember::class,
//        'currentUserPotentialMemberMap' => GroupMember::class
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'detail' => $this->detail(),
            'founder' => $this->founder(),
            'alliedIds' => $this->alliedIds(),
            'allianceStatus' => $this->allianceStatus(),
            'groupJoinInviteCount' => $this->groupJoinInviteCount()
        ];
    }

}