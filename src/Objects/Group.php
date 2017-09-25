<?php
/**
 * pipsqueek-discord
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license http://www.gnu.org/licenses/ GPLv3
 * @version 0.1
 *
 * Built 2017-09-24 07:25 CDT by richard
 *
 *
 */

namespace Destiny\Objects;

use Destiny\AbstractResource;
use Destiny\Enums\RuntimeGroupMemberType;
use JsonSerializable;

/**
 * Class Group
 * @package Destiny\Objects
 *
 * @method string groupId() // "2114315",
 * @method string name() // "The Warren",
 * @method int groupType() // 1, https://bungie-net.github.io/multi/schema_GroupsV2-GroupType.html#schema_GroupsV2-GroupType
 * @method string membershipIdCreated() // "8628538",
 * @method string creationDate() // "2017-08-29T20:31:20.451Z",
 * @method string modificationDate() // "2017-09-21T18:15:59.801Z",
 * @method string about() // "Do you like dairy and/or steaks? Do you have an epic beard? Do you wear purple sweaters? Do you bring your own feathered lemurs to parties? Do you think PopeBear should eat lots of Taco Bell? If you answered yes or no to any of these, you'll fit right in!\n\nThis clan is exclusively for PS4 players! XBox members please visit our sister clan The Warren XBox [WRNX], or if you are on Battle.Net please join our sister clan The Warren BNET [WRNB]",
 * @method string[] tags() // [],
 * @method int memberCount() // 85,
 * @method bool isPublic() // true,
 * @method bool isPublicTopicAdminOnly() // false,
 * @method string primaryAlliedGroupId() // "0",
 * @method string motto() // "Down the rabbit hole we go",
 * @method bool allowChat() // true,
 * @method bool isDefaultPostPublic() // false,
 * @method int chatSecurity() // 0, https://bungie-net.github.io/multi/schema_GroupsV2-ChatSecuritySetting.html#schema_GroupsV2-ChatSecuritySetting
 * @method string locale() // "en",
 * @method int avatarImageIndex() // 0,
 * @method int homepage() // 0, https://bungie-net.github.io/multi/schema_GroupsV2-GroupHomepage.html#schema_GroupsV2-GroupHomepage
 * @method int membershipOption() // 0, https://bungie-net.github.io/multi/schema_GroupsV2-MembershipOption.html#schema_GroupsV2-MembershipOption
 * @method int defaultPublicity() // 2, https://bungie-net.github.io/multi/schema_GroupsV2-GroupPostPublicity.html#schema_GroupsV2-GroupPostPublicity
 * @method string theme() // "Group_Community1",
 * @method string bannerPath() // "/img/Themes/Group_Community1/struct_images/group_top_banner.jpg",
 * @method string avatarPath() // "/img/profile/avatars/group/defaultGroup.png",
 * @method bool isAllianceOwner() // false,
 * @method string conversationId() // "27193710",
 * @method bool enableInvitationMessagingForAdmins() // false,
 * @method string banExpireDate() // "2001-01-01T00:00:00Z",
 * @method bool enableInvitationMessagingForAdmins() // false,
 * @method string banExpireDate() // "2001-01-01T00:00:00Z",
 * @method GroupFeatures features()
 * @method ClanInfoAndInvestment clanInfo()
 */
class Group extends AbstractResource
{

    //protected $casts = [
    //    'features' => GroupFeatures::class,
    //    'clanInfo' => ClanInfoAndInvestment::class
    //];

}