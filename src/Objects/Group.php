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
use JsonSerializable;

/**
 * Class Group
 * @package Destiny\Objects
 *
 * @link https://bungie-net.github.io/multi/schema_GroupsV2-GroupV2.html#schema_GroupsV2-GroupV2
 *
 * @method integer groupId()
 * @method string name()
 * @method int groupType() GroupType enum
 * @method int membershipIdCreated()
 * @method \DateTime creationDate($tz = null)
 * @method \DateTime modificationDate($tz = null)
 * @method string about()
 * @method string[] tags()
 * @method int memberCount()
 * @method boolean isPublic()
 * @method boolean isPublicTopicAdminOnly()
 * @method string motto()
 * @method boolean allowChat()
 * @method boolean isDefaultPostPublic()
 * @method int chatSecurity() ChatSecuritySetting enum
 * @method string locale()
 * @method int avatarImageIndex()
 * @method int homepage() GroupHomepage enum
 * @method int membershipOption() MembershipOption enum
 * @method int defaultPublicity() GroupPostPublicity enum
 * @method string theme()
 * @method string bannerPath()
 * @method string avatarPath()
 * @method int conversationId()
 * @method boolean enableInvitationMessagingForAdmins()
 * @method \DateTime banExpireDate($tz = null)
 * @method GroupFeatures features()
 * @method ClanInfoAndInvestment clanInfo()
 */
class Group extends AbstractResource implements JsonSerializable
{

    /**
     * Deprecated function
     * @return int
     *
     * @deprecated 0.2.6 This has been removed from the API. This function will already return an invalid value and will be removed.
     */
    public function primaryAlliedGroupId() {
        return -1;
    }

    /**
     * Deprecated function
     * @return boolean
     *
     * @deprecated 0.2.6 This has been removed from the API. This function will already return an invalid value and will be removed.
     */
    public function isAllianceOwner() {
        return false;
    }

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     * @deprecated 0.3.0
     */
    protected $dates = [
        'creationDate',
        'modificationDate',
        'banExpireDate'
    ];

    /**
     * @var array Array of columns that will need to be casted to their own class
     */
    protected $casts = [
        'features' => GroupFeatures::class,
        'clanInfo' => ClanInfoAndInvestment::class
    ];

    /**
     * Make JSON ready
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'groupId' => $this->groupId(),
            'name' => $this->name(),
            'groupType' => $this->groupType(),
            'membershipIdCreated' => $this->membershipIdCreated(),
            'creationDate' => $this->creationDate(),
            'modificationDate' => $this->modificationDate(),
            'about' => $this->about(),
            'tags' => $this->tags(),
            'memberCount' => $this->memberCount(),
            'isPublic' => $this->isPublic(),
            'isPublicTopicAdminOnly' => $this->isPublicTopicAdminOnly(),
            'motto' => $this->motto(),
            'allowChat' => $this->allowChat(),
            'isDefaultPostPublic' => $this->isDefaultPostPublic(),
            'locale' => $this->locale(),
            'avatarImageIndex' => $this->avatarImageIndex(),
            'homepage' => $this->homepage(),
            'theme' => $this->theme(),
            'bannerPath' => $this->bannerPath(),
            'avatarPath' => $this->avatarPath(),
            'conversationId' => $this->conversationId(),
            'enableInvitationMessagingForAdmins' => $this->enableInvitationMessagingForAdmins(),
            'banExpireDate' => $this->banExpireDate(),
            'features' => $this->features()
        ];
    }

}