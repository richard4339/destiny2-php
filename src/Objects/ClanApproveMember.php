<?php

namespace Destiny\Objects;


use Destiny\AbstractResource;
use Destiny\Enums\BungieMembershipType;
use Destiny\Enums\PlatformErrorCodes;
use JsonSerializable;

/**
 * Class ClanApproveMember
 * A non-API class meant to make handling the ClanApproveMember's call easier to handle.
 *
 * @package Destiny\Objects
 *
 * @method bool success() "Computed" value, if response is true or the error code is a code that isn't truly a failure such as them getting an invite
 * @method bool|null response()
 * @method int|null errorCode()
 * @method string|null errorStatus()
 * @method string|null message()
 * @method int|null clanID()
 * @method int|string|null membershipType()
 * @method int|string|null membershipID()
 *
 */
class ClanApproveMember extends AbstractResource implements JsonSerializable
{
    /**
     * ClanApproveMember constructor.
     * @param int|null $clanID
     * @param int|string|null $membershipType
     * @param int|string|null $membershipID
     * @param bool|null $response
     * @param int|null $errorCode
     * @param string|null $errorStatus
     * @param string|null $message
     */
    public function __construct(int $clanID = null, $membershipType = null, $membershipID = null, bool $response = null, int $errorCode = null, string $errorStatus = null, string $message = null)
    {

        // Check to see if the supplied membershipType is a number. If not, convert it to the label
        if (is_int($membershipType)) {
            $membershipType = BungieMembershipType::getLabel($membershipType);
        }

        $this->data['success'] = false;
        $this->data['response'] = $response;
        $this->data['errorCode'] = $errorCode;
        $this->data['errorStatus'] = $errorStatus;
        $this->data['message'] = $message;
        $this->data['clanID'] = $clanID;
        $this->data['membershipType'] = $membershipType;
        $this->data['membershipID'] = $membershipID;

        if ($response === true) {
            $this->data['success'] = true;
        } elseif ($errorCode == PlatformErrorCodes::CLANAPPLICANTINCLANSONOWINVITED) {
            $this->data['success'] = true;
        }

        parent::__construct();
    }

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'success' => $this->success(),
            'response' => $this->response(),
            'errorCode' => $this->errorCode(),
            'errorStatus' => $this->errorStatus(),
            'message' => $this->message(),
            'clanID' => $this->clanID(),
            'membershipType' => $this->membershipType(),
            'membershipID' => $this->membershipID(),
        ];
    }
}