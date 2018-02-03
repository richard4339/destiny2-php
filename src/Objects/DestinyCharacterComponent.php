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
use Destiny\Enums\BungieMembershipType;
use JsonSerializable;

/**
 * Class DestinyCharacterComponent
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-Entities-Characters-DestinyCharacterComponent.html#schema_Destiny-Entities-Characters-DestinyCharacterComponent
 *
 * @method int membershipId()
 * @method int membershipType() BungieMembershipType enum
 * @method int characterId()
 * @method \DateTime dateLastPlayed($tz = null)
 * @method int minutesPlayedThisSession() If the user is currently playing, this is how long they've been playing.
 * @method int minutesPlayedTotal() If this value is 525,600, then they played Destiny for a year. Or they're a very dedicated Rent fan. Note that this includes idle time, not just time spent actually in activities shooting things.
 * @methof int light()
 */
class DestinyCharacterComponent extends AbstractResource implements JsonSerializable
{

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     */
    protected $dates = [
        'dateLastPlayed'
    ];

    public function stats() {
        foreach($this->get('stats') as $index => $key) {
            $hash = sprintf('%u', $index & 0xFFFFFFFF);
            $stats[$hash] = $key;
        }

        return $stats;

    }

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'membershipId' => $this->membershipId(),
            'membershipType' => $this->membershipType(),
            'membershipTypeLabel' => BungieMembershipType::getLabel($this->membershipType()),
            'characterId' => $this->characterId(),
            'dateLastPlayed' => $this->dateLastPlayed(),
            'minutesPlayedThisSession' => $this->minutesPlayedThisSession(),
            'minutesPlayedTotal' => $this->minutesPlayedTotal(),
            'stats' => $this->stats()
        ];
    }

}