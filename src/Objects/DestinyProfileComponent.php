<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-10-15 14:32 CDT by richard
 *
 */

namespace Destiny\Objects;


use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class DestinyProfileComponent
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-Entities-Profiles-DestinyProfileComponent.html#schema_Destiny-Entities-Profiles-DestinyProfileComponent
 *
 * @method UserInfoCard userInfo() If you need to render the Profile (their platform name, icon, etc...) somewhere, this property contains that information.
 * @method \DateTime dateLastPlayed($tz = null) The last time the user played with any character on this Profile.
 * @method int versionsOwned() DestinyGameVersions enum If you want to know what expansions they own, this will contain that data.
 * @method int[] characterIds() A list of the character IDs, for further querying on your part.
 */
class DestinyProfileComponent extends AbstractResource implements JsonSerializable
{

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     */
    protected $dates = [
        'dateLastPlayed'
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'userInfo' => $this->userInfo(),
            'dateLastPlayed' => $this->dateLastPlayed(),
            'versionsOwned' => $this->versionsOwned(),
            'characterIds' => $this->characterIds()
        ];
    }

}