<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017-2018, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2018-12-07 09:56 CST by richard
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class StreamInfo
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_StreamInfo.html#schema_StreamInfo
 *
 * @method string ChannelName()
 */
class StreamInfo extends AbstractResource implements JsonSerializable
{

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'channelName' => $this->ChannelName(),
        ];
    }

}