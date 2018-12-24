<?php
/**
 * destiny2-php
 */

namespace Destiny\Tests;

use Destiny\Enums\BungieMembershipType;
use Destiny\Enums\RuntimeGroupMemberType;

/**
 * Class GroupTest
 */
class GroupTest extends ClientTestCase
{

    const TEST_CLANID = "2114315";

    /**
     *
     */
    public function testGetGroupByID()
    {
        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $response = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals('The Warren', $response->detail()->name());
        $this->assertEquals(2114315, $response->detail()->groupId());
        $this->assertEquals(1, $response->detail()->groupType());
        $this->assertEquals(8628538, $response->detail()->membershipIdCreated());
        $this->assertEquals(new \DateTime("2017-08-29T20:31:20.451Z"), $response->detail()->creationDate());
        $this->assertEquals(new \DateTime("2017-11-02T03:13:13.188Z"), $response->detail()->modificationDate());
        $this->assertEquals("Do you have an epic beard(like BriarRabbit)? Do you wear purple sweaters? Do you bring your own feathered lemurs to parties? Do you think PopeBear should eat lots of Taco Bell? If you answered yes or no to any of these, you'll fit right in!\n\nThis clan is exclusively for PS4 players! XBox members please visit our sister clan The Warren XBox [WRNX], or if you are on Battle.Net please join our sister clan The Warren BNET [WRNB]", $response->detail()->about());
        $this->assertEquals(true, $response->detail()->isPublic());
        $this->assertEquals(false, $response->detail()->isPublicTopicAdminOnly());
        $this->assertEquals("Down the rabbit hole we go!", $response->detail()->motto());
        $this->assertEquals(true, $response->detail()->allowChat());
        $this->assertEquals(false, $response->detail()->isDefaultPostPublic());
        $this->assertEquals(0, $response->detail()->chatSecurity());
        $this->assertEquals("en", $response->detail()->locale());
        $this->assertEquals(0, $response->detail()->avatarImageIndex());
        $this->assertEquals(0, $response->detail()->homepage());
        $this->assertEquals(0, $response->detail()->membershipOption());
        $this->assertEquals(2, $response->detail()->defaultPublicity());
        $this->assertEquals("Group_Community1", $response->detail()->theme());
        $this->assertEquals("/img/Themes/Group_Community1/struct_images/group_top_banner.jpg", $response->detail()->bannerPath());
        $this->assertEquals("/img/profile/avatars/group/defaultGroup.png", $response->detail()->avatarPath());
        $this->assertEquals("27193710", $response->detail()->conversationId());
        $this->assertEquals(false, $response->detail()->enableInvitationMessagingForAdmins());
        $this->assertEquals(new \DateTime("2001-01-01T00:00:00Z"), $response->detail()->banExpireDate());
    }

    /**
     *
     */
    public function testGetGroupFounder()
    {
        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $user = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals('richard4339', $user->founder()->destinyUserInfo()->displayName());
    }

    /**
     *
     */
    public function testGetGroupFeatureUpdateBannerPermissionOverride()
    {
        $this->client->setMock(__DIR__ . '/static/getClan.json');

        $permission = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals(true, $permission->detail()->features()->updateBannerPermissionOverride());
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testGetClanPendingMembers()
    {
        $this->client->setMock(__DIR__ . '/static/getClanPendingMembers.json');

        $users = $this->client->getClanPendingMembers(self::TEST_CLANID);

        $this->assertEquals('DelDemon', $users[0]->destinyUserInfo()->displayName());
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testGetClanInvitedMemberName()
    {
        $this->client->setMock(__DIR__ . '/static/getClanInvitedMembers.json');

        $users = $this->client->getClanInvitedMembers(self::TEST_CLANID);

        $this->assertEquals('Phobus', $users[0]->destinyUserInfo()->displayName());
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testGetClanInvitedMemberDateInvited()
    {
        $this->client->setMock(__DIR__ . '/static/getClanInvitedMembers.json');

        $users = $this->client->getClanInvitedMembers(self::TEST_CLANID);

        $this->assertEquals(new \DateTime('2018-11-17T05:25:52.000000+0000'), $users[0]->creationDate());
    }

    /**
     * Tests for getting an empty list of clan members that are banned
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testGetClanBannedMembersNoResults()
    {
        $this->client->setMock(__DIR__ . '/static/getClanBannedMembers-NoResults.json');

        $results = $this->client->getClanBannedMembers(self::TEST_CLANID);

        $this->assertEmpty($results);
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanKickMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Success.json');

        $results = $this->client->clanKickMember(self::TEST_CLANID, BungieMembershipType::TIGERBLIZZARD, '12345');

        $this->assertTrue($results);
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanKickMemberInvalidMember()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Failure-InvalidMember.json');

        $results = $this->client->clanKickMember(self::TEST_CLANID, BungieMembershipType::TIGERBLIZZARD, '12345');
    }


    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanApproveMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanApproveMember.json');

        $results = $this->client->clanApproveMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results->success());
        $this->assertEquals(true, $results->response());
        $this->assertEquals(PlatformErrorCodes::SUCCESS, $results->errorCode());
        $this->assertEquals('Success', $results->errorStatus());
        $this->assertEquals("Ok", $results->message());
        $this->assertEquals(self::TEST_CLANID, $results->clanID());
        $this->assertEquals('12345', $results->membershipID());
        $this->assertEquals(BungieMembershipType::getLabel(BungieMembershipType::TIGERPSN), $results->membershipType());
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanApproveMemberSuccessInAnotherClan()
    {
        $this->client->setMock(__DIR__ . '/static/clanApproveMember-Failure-InAnotherClan.json');

        $results = $this->client->clanApproveMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results->success());
        $this->assertEquals(false, $results->response());
        $this->assertEquals(699, $results->errorCode());
        $this->assertEquals('ClanApplicantInClanSoNowInvited', $results->errorStatus());
        $this->assertEquals("The clan applicant is already a member of a different clan.  Their application to this clan has been converted to a pending invitation, they must accept the invitation before the user will be a member of your clan.", $results->message());
        $this->assertEquals(self::TEST_CLANID, $results->clanID());
        $this->assertEquals('12345', $results->membershipID());
        $this->assertEquals(BungieMembershipType::getLabel(BungieMembershipType::TIGERPSN), $results->membershipType());
    }

    /**
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanApproveMemberInvalidMember()
    {
        $this->client->setMock(__DIR__ . '/static/clanApproveMember-Failure-WrongClan.json');

        $this->client->clanApproveMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
    }

    /**
     * @todo This test is currently designed to fail since the method does not properly return a value
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanDenyMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Success.json');

        $results = $this->client->clanDenyMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345', 'SomeUser');
        $this->assertEquals(true, $results);
    }

    /**
     * Test inviting a member to a clan that they are not currently accepted into
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMember.json');

        $results = $this->client->clanInviteMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results);
    }

    /**
     * Test inviting a member to a clan that they are already invited into
     * Note that the API treats this as if they have not already been invited
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberSuccessAlreadyInvited()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMember.json');

        $results = $this->client->clanInviteMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results);

    }

    /**
     * Test inviting a member to a clan that they are already a member of
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberSuccessAlreadyInClan()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMember-AlreadyInClan.json');

        $this->client->clanInviteMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
    }

    /**
     * Test cancelling a member invitation
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberCancelSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMemberCancel.json');

        $results = $this->client->clanInviteMemberCancel(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results);
    }

    /**
     * Test cancelling a member invitation when the member is not invited
     * Note that the API treats this as if they have been invited
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberCancelNotInvited()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMemberCancel.json');

        $results = $this->client->clanInviteMemberCancel(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results);
    }

    /**
     * Test cancelling a clan invitation for a clan you do not have access to manage
     *
     * @expectedException \Destiny\Exceptions\OAuthException
     */
    public function testClanInviteMemberCancelAccessDenied()
    {
        $this->client->setMock(__DIR__ . '/static/clanInviteMemberCancel-AccessDenied.json');

        $this->client->clanInviteMemberCancel(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
    }

    /**
     *
     */
    public function testGetClanMembersSuccess()
    {

        $this->client->setMock(__DIR__ . '/static/getClanMembers.json');

        $results = $this->client->getClanMembers(self::TEST_CLANID);

        $this->assertCount(87, $results);

        $this->assertEquals(RuntimeGroupMemberType::BEGINNER, $results[0]->memberType());
        $this->assertEquals(1, $results[0]->memberType());
        $this->assertTrue($results[0]->isOnline());
        $this->assertEquals(2114315, $results[0]->groupId());
        $this->assertEquals(new \DateTime('2017-09-15T08:58:54Z'), $results[0]->joinDate());

        $this->assertEquals("/img/theme/destiny/icons/icon_psn.png", $results[0]->destinyUserInfo()->iconPath());
        $this->assertEquals(2, $results[0]->destinyUserInfo()->membershipType());
        $this->assertEquals("4611686018465829068", $results[0]->destinyUserInfo()->membershipId());
        $this->assertEquals("Harrax_Gamer", $results[0]->destinyUserInfo()->displayName());

        $this->assertEquals("15884163", $results[0]->bungieNetUserInfo()->supplementalDisplayName());
        $this->assertEquals("/img/profile/avatars/default_avatar.gif", $results[0]->bungieNetUserInfo()->iconPath());
        $this->assertEquals(254, $results[0]->bungieNetUserInfo()->membershipType());
        $this->assertEquals("15884163", $results[0]->bungieNetUserInfo()->membershipId());
        $this->assertEquals("Harrax_Gamer", $results[0]->bungieNetUserInfo()->displayName());

        $this->assertEquals(RuntimeGroupMemberType::BEGINNER, $results[1]->memberType());
        $this->assertEquals(1, $results[1]->memberType());
        $this->assertFalse($results[1]->isOnline());
        $this->assertEquals(2114315, $results[1]->groupId());
        $this->assertEquals(new \DateTime('2017-09-11T15:47:21Z'), $results[1]->joinDate());

        $this->assertEquals("/img/theme/destiny/icons/icon_psn.png", $results[1]->destinyUserInfo()->iconPath());
        $this->assertEquals(2, $results[1]->destinyUserInfo()->membershipType());
        $this->assertEquals("4611686018432172351", $results[1]->destinyUserInfo()->membershipId());
        $this->assertEquals("stingwray", $results[1]->destinyUserInfo()->displayName());

        $this->assertEquals("9503851", $results[1]->bungieNetUserInfo()->supplementalDisplayName());
        $this->assertEquals("/img/profile/avatars/default_avatar.gif", $results[1]->bungieNetUserInfo()->iconPath());
        $this->assertEquals(254, $results[1]->bungieNetUserInfo()->membershipType());
        $this->assertEquals("9503851", $results[1]->bungieNetUserInfo()->membershipId());
        $this->assertEquals("stingwray", $results[1]->bungieNetUserInfo()->displayName());
    }

}
