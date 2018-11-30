<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Tests;

use Destiny\Client;
use Destiny\Enums\BungieMembershipType;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class GroupTest
 */
class GroupTest extends ClientOauthTestCase
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
     *
     */
    public function testGetClanPendingMembers()
    {
        $this->client->setMock(__DIR__ . '/static/getClanPendingMembers.json');

        $users = $this->client->getClanPendingMembers(self::TEST_CLANID);

        $this->assertEquals('DelDemon', $users[0]->destinyUserInfo()->displayName());
    }

    /**
     *
     */
    public function testGetClanInvitedMemberName() {
        $this->client->setMock(__DIR__ . '/static/getClanInvitedMembers.json');

        $users = $this->client->getClanInvitedMembers(self::TEST_CLANID);

        $this->assertEquals('Phobus', $users[0]->destinyUserInfo()->displayName());
    }

    /**
     *
     */
    public function testGetClanInvitedMemberDateInvited() {
        $this->client->setMock(__DIR__ . '/static/getClanInvitedMembers.json');

        $users = $this->client->getClanInvitedMembers(self::TEST_CLANID);

        $this->assertEquals(new \DateTime('2018-11-17T05:25:52.000000+0000'), $users[0]->creationDate());
    }

    /**
     * Tests for getting an empty list of clan members that are banned
     */
    public function testGetClanBannedMembersNoResults()
    {
        $this->client->setMock(__DIR__ . '/static/getClanBannedMembers-NoResults.json');

        $results = $this->client->getClanBannedMembers(self::TEST_CLANID);

        $this->assertEmpty($results);
    }

    /**
     *
     */
    public function testClanKickMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Success.json');

        $results = $this->client->clanKickMember(self::TEST_CLANID, BungieMembershipType::TIGERBLIZZARD, '12345');

        $this->assertNotEmpty($results);
    }

    /**
     * @expectedException \Destiny\Exceptions\ClientException
     * @expectedExceptionCode 611
     */
    public function testClanKickMemberInvalidMember()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Failure-InvalidMember.json');

        $results = $this->client->clanKickMember(self::TEST_CLANID, BungieMembershipType::TIGERBLIZZARD, '12345');
    }

    /**
     * @todo This test is currently designed to fail since the method does not properly return a value
     */
    public function testClanApproveMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Success.json');

        $results = $this->client->clanApproveMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
        $this->assertEquals(true, $results);
    }

    /**
     * @expectedException \Destiny\Exceptions\ClientException
     * @expectedExceptionCode 606
     */
    public function testClanApproveMemberInvalidMember()
    {
        $this->client->setMock(__DIR__ . '/static/clanApproveMember-Failure-WrongClan.json');

        $this->client->clanApproveMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345');
    }

    /**
     * @todo This test is currently designed to fail since the method does not properly return a value
     */
    public function testClanDenyMemberSuccess()
    {
        $this->client->setMock(__DIR__ . '/static/clanKickMember-Success.json');

        $results = $this->client->clanDenyMember(self::TEST_CLANID, BungieMembershipType::TIGERPSN, '12345', 'SomeUser');
        $this->assertEquals(true, $results);
    }

}
