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
use Destiny\Enums\BungieMembershipType;
use JsonSerializable;

/**
 * Class UserInfoCard
 * This contract supplies basic information commonly used to display a minimal amount of information about a user. Take
 * care to not add more properties here unless the property applies in all (or at least the majority) of the situations
 * where UserInfoCard is used. Avoid adding game specific or platform specific details here. In cases where UserInfoCard
 * is a subset of the data needed in a contract, use UserInfoCard as a property of other contracts.
 *
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_User-UserInfoCard.html#schema_User-UserInfoCard
 *
 * @method string supplementalDisplayName() A platform specific additional display name - ex: psn Real Name, bnet Unique Name, etc.
 * @method string iconPath() URL the Icon if available.
 * @method int membershipType() BungieMembershipType enum Type of the membership.
 * @method string membershipId() Membership ID as they user is known in the Accounts service
 * The API reference states this is an int but it is returned as a string
 * @method string displayName() Display Name the player has chosen for themselves. The display name is optional when the data type is used as input to a platform API.
 */
class UserInfoCard extends AbstractResource implements JsonSerializable
{

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'supplementalDisplayName' => $this->supplementalDisplayName(),
            'iconPath' => $this->iconPath(),
            'membershipType' => $this->membershipType(),
            'membershipId' => $this->membershipId(),
            'displayName' => $this->displayName()
        ];
    }

    /**
     * @return string
     */
    public function membershipTypeLabel() {
        return BungieMembershipType::getLabel($this->membershipType());
    }

}