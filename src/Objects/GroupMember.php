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
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use JsonSerializable;

/**
 * Class GroupMember
 * @package Destiny\Objects
 *
 * @method int memberType()
 * @method bool isOnline()
 * @method string groupId()
 * @method string joinDate()
 * @method DestinyUserInfo destinyUserInfo()
 * @method BungieNetUserInfo bungieNetUserInfo()
 */
class GroupMember extends AbstractResource
{

    protected $casts = [
        'destinyUserInfo' => DestinyUserInfo::class,
        'bungieNetUserInfo' => BungieNetUserInfo::class
    ];

}