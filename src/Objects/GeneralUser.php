<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-28 12:18 CDT by richard
 *
 *
 */

namespace Destiny\Objects;


use Destiny\AbstractResource;

/**
 * Class GeneralUser
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_User-GeneralUser.html#schema_User-GeneralUser
 *
 * @method integer membershipId()
 * @method string uniqueName()
 * @method string normalizedName()
 * @method string displayName()
 * @method integer profilePicture()
 * @method integer profileTheme()
 * @method integer userTitle()
 * @method integer successMessageFlags()
 * @method boolean isDeleted()
 * @method string about()
 * @method \DateTime firstAccess($tz = null)
 * @method \DateTime lastUpdate($tz = null)
 * @method integer legacyPortalUID()
 * @method string psnDisplayName()
 * @method string xboxDisplayName()
 * @method string fbDisplayName()
 * @method boolean showActivity()
 * @method string locale()
 * @method boolean localeInheritDefault()
 * @method integer lastBanReportId()
 * @method boolean showGroupMessaging()
 * @method string profilePicturePath()
 * @method string profilePictureWidePath()
 * @method string profileThemeName()
 * @method string userTitleDisplay()
 * @method string statusText()
 * @method \DateTime statusDate($tz = null)
 * @method string profileBanExpire()
 * @method string blizzardDisplayName()
 */
class GeneralUser extends AbstractResource
{

    protected $dates = ['firstAccess', 'lastUpdate', 'statusDate'];

}