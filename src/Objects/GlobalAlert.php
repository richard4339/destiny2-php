<?php

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\GlobalAlertLevel;
use Destiny\Enums\GlobalAlertType;
use JsonSerializable;

/**
 * Class GlobalAlert
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GlobalAlert.html#schema_GlobalAlert
 *
 * @method string AlertKey()
 * @method string AlertHtml()
 * @method \DateTime AlertTimestamp($tz = null)
 * @method string AlertLink()
 * @method string AlertLevel() GlobalAlertLevel enum
 * @method string AlertType() GlobalAlertType enum
 * @method StreamInfo|null StreamInfo()
 *
 */
class GlobalAlert extends AbstractResource implements JsonSerializable
{


    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'StreamInfo' => StreamInfo::class,
    ];

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     */
    protected $dates = [
        'AlertTimestamp'
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'alertKey' => $this->AlertKey(),
            'alertHtml' => $this->AlertHtml(),
            'alertTimestamp' => $this->AlertTimestamp(),
            'alertLink' => $this->AlertLink(),
            'alertLevel' => $this->AlertLevel(),
            'alertLevelLabel' => GlobalAlertLevel::getLabel($this->AlertLevel()),
            'alertType' => $this->AlertType(),
            'alertTypeLabel' => GlobalAlertType::getLabel($this->AlertType()),
            'streamInfo' => $this->StreamInfo(),
        ];
    }

}