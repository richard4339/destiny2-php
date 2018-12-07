<?php

namespace Destiny\Tests;

use Destiny\Client;
use Destiny\Enums\BungieMembershipType;
use Destiny\Exceptions\OAuthException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;

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

        $user = $this->client->getGroup(self::TEST_CLANID);

        $this->assertEquals('The Warren', $user->detail()->name());
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

        $this->assertNotEmpty($results);
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
        $this->assertEquals(true, $results);
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

}
