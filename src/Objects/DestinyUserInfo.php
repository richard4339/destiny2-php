<?php
/**
 * pipsqueek-discord
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license http://www.gnu.org/licenses/ GPLv3
 * @version 0.1
 *
 * Built 2017-09-23 10:25 CDT by richard
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class DestinyUserInfo
 * @package Destiny\Objects
 *
 * @method string iconPath()
 * @method int membershipType()
 * @method string membershipId()
 * @method string displayName()
 */
class DestinyUserInfo extends AbstractResource implements JsonSerializable
{

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'iconPath' => $this->iconPath(),
            'membershipType' => $this->membershipType(),
            'membershipId' => $this->membershipId(),
            'displayName' => $this->displayName()
        ];
    }

}