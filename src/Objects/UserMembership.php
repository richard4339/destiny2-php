<?php

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\BungieMembershipType;
use JsonSerializable;

/**
 * Class UserMembership
 * Very basic info about a user as returned by the Account server.
 *
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_User-UserMembership.html#schema_User-UserMembership
 *
 * @method int membershipType() BungieMembershipType enum Type of the membership.
 * @method string membershipId() Membership ID as they user is known in the Accounts service
 * The API reference states this is an int but it is returned as a string
 * @method string displayName() Display Name the player has chosen for themselves. The display name is optional when the data type is used as input to a platform API.
 */
class UserMembership extends AbstractResource implements JsonSerializable
{

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'membershipType' => $this->membershipType(),
            'membershipId' => $this->membershipId(),
            'displayName' => $this->displayName()
        ];
    }

    /**
     * UserMembership constructor.
     * @param int|string $membershipType
     * @param string $membershipID
     * @param string $displayName
     */
    public function __construct($membershipType, string $membershipID, string $displayName)
    {

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }
        if ($membershipType == "None" || $membershipType == "") {
            throw new ClientException('An invalid MembershipType was supplied.');
        }

        $this->data['membershipType'] = $membershipType;
        $this->data['membershipId'] = $membershipID;
        $this->data['displayName'] = $displayName;

        parent::__construct();
    }

}