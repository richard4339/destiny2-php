<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-10-01 12:32 CDT by richard
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\BungieMembershipType;
use Destiny\Enums\Capabilities;
use Destiny\Enums\HostGuidedGamesPermissionLevel;
use Destiny\Enums\RuntimeGroupMemberType;
use JsonSerializable;

/**
 * Class GroupFeatures
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupFeatures.html#schema_GroupsV2-GroupFeatures
 *
 * @method int maximumMembers()
 * @method int maximumMembershipsOfGroupType() Maximum number of groups of this type a typical membership may join. For example, a user may join about 50 General groups with their Bungie.net account. They may join one clan per Destiny membership.
 * @method int capabilities() Capabilities enum
 * @method int[] membershipTypes() BungieMembershipType enum
 * @method boolean invitePermissionOverride() Minimum Member Level allowed to invite new members to group Always Allowed: Founder, Acting Founder True means admins have this power, false means they don't Default is false for clans, true for groups.
 * @method boolean updateCulturePermissionOverride() Minimum Member Level allowed to update group culture Always Allowed: Founder, Acting Founder True means admins have this power, false means they don't Default is false for clans, true for groups.
 * @method int hostGuidedGamePermissionOverride() HostGuidedGamesPermissionLevel enum
 * @method boolean updateBannerPermissionOverride() Minimum Member Level allowed to update banner Always Allowed: Founder, Acting Founder True means admins have this power, false means they don't Default is false for clans, true for groups.
 * @method int joinLevel() RuntimeGroupMemberType enum
 *
 */
class GroupFeatures extends AbstractResource implements JsonSerializable
{

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $membershipTypes = [];
        foreach($this->membershipTypes() as $i) {
            $membershipTypes[] = BungieMembershipType::getLabel($i);
        }
        $features = [
            'maximumMembers' => $this->maximumMembers(),
            'maximumMembershipsOfGroupType' => $this->maximumMembershipsOfGroupType(),
            'capabilities' => $this->capabilities(),
            'membershipTypes' => $this->membershipTypes(),
            'membershipTypesLabels' => $membershipTypes,
            'invitePermissionOverride' => $this->invitePermissionOverride(),
            'updateCulturePermissionOverride' => $this->updateCulturePermissionOverride(),
            'hostGuidedGamePermissionOverride' => $this->hostGuidedGamePermissionOverride(),
            'hostGuidedGamePermissionOverrideLabel' => HostGuidedGamesPermissionLevel::getLabel($this->hostGuidedGamePermissionOverride()),
            'updateBannerPermissionOverride' => $this->updateBannerPermissionOverride(),
            'joinLevel' => $this->joinLevel(),
            'joinLevelLabel' => RuntimeGroupMemberType::getLabel($this->joinLevel())
        ];

        return $features;
    }

}