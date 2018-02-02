<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-10-15 13:18 CDT by richard
 *
 */

namespace Destiny\Enums;

/**
 * Class DestinyComponentType
 * @package Destiny\Enums
 *
 * @link https://bungie-net.github.io/multi/schema_Destiny-DestinyComponentType.html#schema_Destiny-DestinyComponentType
 */
class DestinyComponentType implements Enum
{
    /**
     * None
     */
    const NONE = 0;
    /**
     * Profiles is the most basic component, only relevant when calling GetProfile. This returns basic information about the profile, which is almost nothing: a list of characterIds, some information about the last time you logged in, and that most sobering statistic: how long you've played.
     */
    const PROFILES = 100;
    /**
     * Only applicable for GetProfile, this will return information about receipts for refundable vendor items.
     */
    const VENDORRECEIPTS = 101;
    /**
     * Asking for this will get you the profile-level inventories, such as your Vault buckets (yeah, the Vault is really inventory buckets located on your Profile)
     */
    const PROFILEINVENTORIES = 102;
    /**
     * This will get you a summary of items on your Profile that we consider to be "currencies", such as Glimmer. I mean, if there's Glimmer in Destiny 2. I didn't say there was Glimmer.
     */
    const PROFILECURRENCIES = 103;
    /**
     * This will get you summary info about each of the characters in the profile.
     */
    const CHARACTERS = 200;
    /**
     * This will get you information about any non-equipped items on the character or character(s) in question, if you're allowed to see it. You have to either be authenticated as that user, or that user must allow anonymous viewing of their non-equipped items in Bungie.Net settings to actually get results.
     */
    const CHARACTERINVENTORIES = 201;
    /**
     * This will get you information about the progression (faction, experience, etc... "levels") relevant to each character, if you are the currently authenticated user or the user has elected to allow anonymous viewing of its progression info.
     */
    const CHARACTERPROGRESSIONS = 202;
    /**
     * This will get you just enough information to be able to render the character in 3D if you have written a 3D rendering library for Destiny Characters, or "borrowed" ours. It's okay, I won't tell anyone if you're using it. I'm no snitch. (actually, we don't care if you use it - go to town)
     */
    const CHARACTERRENDERDATA = 203;
    /**
     * This will return info about activities that a user can see and gating on it, if you are the currently authenticated user or the user has elected to allow anonymous viewing of its progression info. Note that the data returned by this can be unfortunately problematic and relatively unreliable in some cases. We'll eventually work on making it more consistently reliable.
     */
    const CHARACTERACTIVITIES = 204;
    /**
     * This will return info about the equipped items on the character(s). Everyone can see this.
     */
    const CHARACTEREQUIPMENT = 205;
    /**
     * This will return basic info about instanced items - whether they can be equipped, their tracked status, and some info commonly needed in many places (current damage type, primary stat value, etc)
     */
    const ITEMINSTANCES = 300;
    /**
     * Items can have Objectives (DestinyObjectiveDefinition) bound to them. If they do, this will return info for items that have such bound objectives.
     */
    const ITEMOBJECTIVES = 301;
    /**
     * Items can have perks (DestinyPerkDefinition). If they do, this will return info for what perks are active on items.
     */
    const ITEMPERKS = 302;
    /**
     * If you just want to render the weapon, this is just enough info to do that rendering.
     */
    const ITEMRENDERDATA = 303;
    /**
     * Items can have stats, like rate of fire. Asking for this component will return requested item's stats if they have stats.
     */
    const ITEMSTATS = 304;
    /**
     * Items can have sockets, where plugs can be inserted. Asking for this component will return all info relevant to the sockets on items that have them.
     */
    const ITEMSOCKETS = 305;
    /**
     * Items can have talent grids, though that matters a lot less frequently than it used to. Asking for this component will return all relevant info about activated Nodes and Steps on this talent grid, like the good ol' days.
     */
    const ITEMTALENTGRIDS = 306;
    /**
     * Items that *aren't* instanced still have important information you need to know: how much of it you have, the itemHash so you can look up their DestinyInventoryItemDefinition, whether they're locked, etc... Both instanced and non-instanced items will have these properties.
     */
    const ITEMCOMMONDATA = 307;
    /**
     * Items that are "Plugs" can be inserted into sockets. This returns statuses about those plugs and why they can/can't be inserted. I hear you giggling, there's nothing funny about inserting plugs. Get your head out of the gutter and pay attention
     */
    const ITEMPLUGSTATES = 308;
    /**
     * When obtaining vendor information, this will return summary information about the Vendor or Vendors being returned.
     */
    const VENDORS = 400;
    /**
     * When obtaining vendor information, this will return information about the categories of items provided by the Vendor.
     */
    const VENDORCATEGORIES = 401;
    /**
     * When obtaining vendor information, this will return the information about items being sold by the Vendor.
     */
    const VENDORSALES = 402;
    /**
     * Asking for this component will return you the account's Kiosk statuses: that is, what items have been filled out/acquired. But only if you are the currently authenticated user or the user has elected to allow anonymous viewing of its progression info.
     */
    const KIOSKS = 500;

    /**
     * @param int $type
     * @return string
     */
    public static function getLabel($type)
    {
        switch ($type) {
            case self::NONE:
                return "None";
                break;
            case self::PROFILES:
                return "Profiles";
                break;
            case self::VENDORRECEIPTS:
                return "VendorReceipts";
                break;
            case self::PROFILEINVENTORIES:
                return "ProfileInventories";
                break;
            case self::PROFILECURRENCIES:
                return "ProfileCurrencies";
                break;
            case self::CHARACTERS:
                return "Characters";
                break;
            case self::CHARACTERINVENTORIES:
                return "CharacterInventories";
                break;
            case self::CHARACTERPROGRESSIONS:
                return "CharacterProgressions";
                break;
            case self::CHARACTERRENDERDATA:
                return "CharacterRenderData";
                break;
            case self::CHARACTERACTIVITIES:
                return "CharacterActivities";
                break;
            case self::CHARACTEREQUIPMENT:
                return "CharacterEquipment";
                break;
            case self::ITEMINSTANCES:
                return "ItemInstances";
                break;
            case self::ITEMOBJECTIVES:
                return "ItemObjectives";
                break;
            case self::ITEMPERKS:
                return "ItemPerks";
                break;
            case self::ITEMRENDERDATA:
                return "ItemRenderData";
                break;
            case self::ITEMSTATS:
                return "ItemStats";
                break;
            case self::ITEMSOCKETS:
                return "ItemSockets";
                break;
            case self::ITEMTALENTGRIDS:
                return "ItemTalentGrids";
                break;
            case self::ITEMCOMMONDATA:
                return "ItemCommonData";
                break;
            case self::ITEMPLUGSTATES:
                return "ItemPlugStates";
                break;
            case self::VENDORS:
                return "Vendors";
                break;
            case self::VENDORCATEGORIES:
                return "VendorCategories";
                break;
            case self::VENDORSALES:
                return "VendorSales";
                break;
            case self::KIOSKS:
                return "Kiosks";
                break;
            default:
                return "";
                break;
        }
    }

}