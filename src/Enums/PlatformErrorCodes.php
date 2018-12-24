<?php
/**
 * destiny2-php
 */

namespace Destiny\Enums;

class PlatformErrorCodes implements Enum
{

    /**
     *
     */
    const NONE = 0;

    /**
     *
     */
    const SUCCESS = 1;

    /**
     *
     */
    const TRANSPORTEXCEPTION = 2;

    /**
     *
     */
    const UNHANDLEDEXCEPTION = 3;

    /**
     *
     */
    const NOTIMPLEMENTED = 4;

    /**
     *
     */
    const SYSTEMDISABLED = 5;

    /**
     *
     */
    const FAILEDTOLOADAVAILABLELOCALESCONFIGURATION = 6;

    /**
     *
     */
    const PARAMETERPARSEFAILURE = 7;

    /**
     *
     */
    const PARAMETERINVALIDRANGE = 8;

    /**
     *
     */
    const BADREQUEST = 9;

    /**
     *
     */
    const AUTHENTICATIONINVALID = 10;

    /**
     *
     */
    const DATANOTFOUND = 11;

    /**
     *
     */
    const INSUFFICIENTPRIVILEGES = 12;

    /**
     *
     */
    const DUPLICATE = 13;

    /**
     *
     */
    const UNKNOWNSQLRESULT = 14; // Deprecated, please do not check for this value anywhere.

    /**
     *
     */
    const VALIDATIONERROR = 15;

    /**
     *
     */
    const VALIDATIONMISSINGFIELDERROR = 16;

    /**
     *
     */
    const VALIDATIONINVALIDINPUTERROR = 17;

    /**
     *
     */
    const INVALIDPARAMETERS = 18;

    /**
     *
     */
    const PARAMETERNOTFOUND = 19;

    /**
     *
     */
    const UNHANDLEDHTTPEXCEPTION = 20;

    /**
     *
     */
    const NOTFOUND = 21;

    /**
     *
     */
    const WEBAUTHMODULEASYNCFAILED = 22;

    /**
     *
     */
    const INVALIDRETURNVALUE = 23;

    /**
     *
     */
    const USERBANNED = 24;

    /**
     *
     */
    const INVALIDPOSTBODY = 25;

    /**
     *
     */
    const MISSINGPOSTBODY = 26;

    /**
     *
     */
    const EXTERNALSERVICETIMEOUT = 27;

    /**
     *
     */
    const VALIDATIONLENGTHERROR = 28;

    /**
     *
     */
    const VALIDATIONRANGEERROR = 29;

    /**
     *
     */
    const JSONDESERIALIZATIONERROR = 30;

    /**
     *
     */
    const THROTTLELIMITEXCEEDED = 31;

    /**
     *
     */
    const VALIDATIONTAGERROR = 32;

    /**
     *
     */
    const VALIDATIONPROFANITYERROR = 33;

    /**
     *
     */
    const VALIDATIONURLFORMATERROR = 34;

    /**
     *
     */
    const THROTTLELIMITEXCEEDEDMINUTES = 35;

    /**
     *
     */
    const THROTTLELIMITEXCEEDEDMOMENTARILY = 36;

    /**
     *
     */
    const THROTTLELIMITEXCEEDEDSECONDS = 37;

    /**
     *
     */
    const EXTERNALSERVICEUNKNOWN = 38;

    /**
     *
     */
    const VALIDATIONWORDLENGTHERROR = 39;

    /**
     *
     */
    const VALIDATIONINVISIBLEUNICODE = 40;

    /**
     *
     */
    const VALIDATIONBADNAMES = 41;

    /**
     *
     */
    const EXTERNALSERVICEFAILED = 42;

    /**
     *
     */
    const SERVICERETIRED = 43;

    /**
     *
     */
    const UNKNOWNSQLEXCEPTION = 44;

    /**
     *
     */
    const UNSUPPORTEDLOCALE = 45;

    /**
     *
     */
    const INVALIDPAGENUMBER = 46;

    /**
     *
     */
    const MAXIMUMPAGESIZEEXCEEDED = 47;

    /**
     *
     */
    const SERVICEUNSUPPORTED = 48;

    /**
     *
     */
    const VALIDATIONMAXIMUMUNICODECOMBININGCHARACTERS = 49;

    /**
     *
     */
    const VALIDATIONMAXIMUMSEQUENTIALCARRIAGERETURNS = 50;

    /**
     *
     */
    const PERENDPOINTREQUESTTHROTTLEEXCEEDED = 51;

    /**
     *
     */
    const AUTHCONTEXTCACHEASSERTION = 52;

    /**
     *
     */
    const EXPLATFORMSTRINGVALIDATIONERROR = 53;

    /**
     *
     */
    const OBSOLETECREDENTIALTYPE = 89;

    /**
     *
     */
    const UNABLETOUNPAIRMOBILEAPP = 90;

    /**
     *
     */
    const UNABLETOPAIRMOBILEAPP = 91;

    /**
     *
     */
    const CANNOTUSEMOBILEAUTHWITHNONMOBILEPROVIDER = 92;

    /**
     *
     */
    const MISSINGDEVICECOOKIE = 93;

    /**
     *
     */
    const FACEBOOKTOKENEXPIRED = 94;

    /**
     *
     */
    const AUTHTICKETREQUIRED = 95;

    /**
     *
     */
    const COOKIECONTEXTREQUIRED = 96;

    /**
     *
     */
    const UNKNOWNAUTHENTICATIONERROR = 97;

    /**
     *
     */
    const BUNGIENETACCOUNTCREATIONREQUIRED = 98;

    /**
     *
     */
    const WEBAUTHREQUIRED = 99;

    /**
     *
     */
    const CONTENTUNKNOWNSQLRESULT = 100;

    /**
     *
     */
    const CONTENTNEEDUNIQUEPATH = 101;

    /**
     *
     */
    const CONTENTSQLEXCEPTION = 102;

    /**
     *
     */
    const CONTENTNOTFOUND = 103;

    /**
     *
     */
    const CONTENTSUCCESSWITHTAGADDFAIL = 104;

    /**
     *
     */
    const CONTENTSEARCHMISSINGPARAMETERS = 105;

    /**
     *
     */
    const CONTENTINVALIDID = 106;

    /**
     *
     */
    const CONTENTPHYSICALFILEDELETIONERROR = 107;

    /**
     *
     */
    const CONTENTPHYSICALFILECREATIONERROR = 108;

    /**
     *
     */
    const CONTENTPERFORCESUBMISSIONERROR = 109;

    /**
     *
     */
    const CONTENTPERFORCEINITIALIZATIONERROR = 110;

    /**
     *
     */
    const CONTENTDEPLOYMENTPACKAGENOTREADYERROR = 111;

    /**
     *
     */
    const CONTENTUPLOADFAILED = 112;

    /**
     *
     */
    const CONTENTTOOMANYRESULTS = 113;

    /**
     *
     */
    const CONTENTINVALIDSTATE = 115;

    /**
     *
     */
    const CONTENTNAVIGATIONPARENTNOTFOUND = 116;

    /**
     *
     */
    const CONTENTNAVIGATIONPARENTUPDATEERROR = 117;

    /**
     *
     */
    const DEPLOYMENTPACKAGENOTEDITABLE = 118;

    /**
     *
     */
    const CONTENTVALIDATIONERROR = 119;

    /**
     *
     */
    const CONTENTPROPERTIESVALIDATIONERROR = 120;

    /**
     *
     */
    const CONTENTTYPENOTFOUND = 121;

    /**
     *
     */
    const DEPLOYMENTPACKAGENOTFOUND = 122;

    /**
     *
     */
    const CONTENTSEARCHINVALIDPARAMETERS = 123;

    /**
     *
     */
    const CONTENTITEMPROPERTYAGGREGATIONERROR = 124;

    /**
     *
     */
    const DEPLOYMENTPACKAGEFILENOTFOUND = 125;

    /**
     *
     */
    const CONTENTPERFORCEFILEHISTORYNOTFOUND = 126;

    /**
     *
     */
    const CONTENTASSETZIPCREATIONFAILURE = 127;

    /**
     *
     */
    const CONTENTASSETZIPCREATIONBUSY = 128;

    /**
     *
     */
    const CONTENTPROJECTNOTFOUND = 129;

    /**
     *
     */
    const CONTENTFOLDERNOTFOUND = 130;

    /**
     *
     */
    const CONTENTPACKAGESINCONSISTENT = 131;

    /**
     *
     */
    const CONTENTPACKAGESINVALIDSTATE = 132;

    /**
     *
     */
    const CONTENTPACKAGESINCONSISTENTTYPE = 133;

    /**
     *
     */
    const CONTENTCANNOTDELETEPACKAGE = 134;

    /**
     *
     */
    const CONTENTLOCKEDFORCHANGES = 135;

    /**
     *
     */
    const CONTENTFILEUPLOADFAILED = 136;

    /**
     *
     */
    const CONTENTNOTREVIEWED = 137;

    /**
     *
     */
    const CONTENTPERMISSIONDENIED = 138;

    /**
     *
     */
    const CONTENTINVALIDEXTERNALURL = 139;

    /**
     *
     */
    const CONTENTEXTERNALFILECANNOTBEIMPORTEDLOCALLY = 140;

    /**
     *
     */
    const CONTENTTAGSAVEFAILURE = 141;

    /**
     *
     */
    const CONTENTPERFORCEUNMATCHEDFILEERROR = 142;

    /**
     *
     */
    const CONTENTPERFORCECHANGELISTRESULTNOTFOUND = 143;

    /**
     *
     */
    const CONTENTPERFORCECHANGELISTFILEITEMSNOTFOUND = 144;

    /**
     *
     */
    const CONTENTPERFORCEINVALIDREVISIONERROR = 145;

    /**
     *
     */
    const CONTENTUNLOADEDSAVERESULT = 146;

    /**
     *
     */
    const CONTENTPROPERTYINVALIDNUMBER = 147;

    /**
     *
     */
    const CONTENTPROPERTYINVALIDURL = 148;

    /**
     *
     */
    const CONTENTPROPERTYINVALIDDATE = 149;

    /**
     *
     */
    const CONTENTPROPERTYINVALIDSET = 150;

    /**
     *
     */
    const CONTENTPROPERTYCANNOTDESERIALIZE = 151;

    /**
     *
     */
    const CONTENTREGEXVALIDATIONFAILONPROPERTY = 152;

    /**
     *
     */
    const CONTENTMAXLENGTHFAILONPROPERTY = 153;

    /**
     *
     */
    const CONTENTPROPERTYUNEXPECTEDDESERIALIZATIONERROR = 154;

    /**
     *
     */
    const CONTENTPROPERTYREQUIRED = 155;

    /**
     *
     */
    const CONTENTCANNOTCREATEFILE = 156;

    /**
     *
     */
    const CONTENTINVALIDMIGRATIONFILE = 157;

    /**
     *
     */
    const CONTENTMIGRATIONALTERINGPROCESSEDITEM = 158;

    /**
     *
     */
    const CONTENTPROPERTYDEFINITIONNOTFOUND = 159;

    /**
     *
     */
    const CONTENTREVIEWDATACHANGED = 160;

    /**
     *
     */
    const CONTENTROLLBACKREVISIONNOTINPACKAGE = 161;

    /**
     *
     */
    const CONTENTITEMNOTBASEDONLATESTREVISION = 162;

    /**
     *
     */
    const CONTENTUNAUTHORIZED = 163;

    /**
     *
     */
    const CONTENTCANNOTCREATEDEPLOYMENTPACKAGE = 164;

    /**
     *
     */
    const CONTENTUSERNOTFOUND = 165;

    /**
     *
     */
    const CONTENTLOCALEPERMISSIONDENIED = 166;

    /**
     *
     */
    const CONTENTINVALIDLINKTOINTERNALENVIRONMENT = 167;

    /**
     *
     */
    const CONTENTINVALIDBLACKLISTEDCONTENT = 168;

    /**
     *
     */
    const CONTENTMACROMALFORMEDNOCONTENTID = 169;

    /**
     *
     */
    const CONTENTMACROMALFORMEDNOTEMPLATETYPE = 170;

    /**
     *
     */
    const CONTENTILLEGALBNETMEMBERSHIPID = 171;

    /**
     *
     */
    const CONTENTLOCALEDIDNOTMATCHEXPECTED = 172;

    /**
     *
     */
    const CONTENTBABELCALLFAILED = 173;

    /**
     *
     */
    const CONTENTENGLISHPOSTLIVEFORBIDDEN = 174;

    /**
     *
     */
    const CONTENTLOCALEEDITPERMISSIONDENIED = 175;

    /**
     *
     */
    const USERNONUNIQUENAME = 200;

    /**
     *
     */
    const USERMANUALLINKINGSTEPREQUIRED = 201;

    /**
     *
     */
    const USERCREATEUNKNOWNSQLRESULT = 202;

    /**
     *
     */
    const USERCREATEUNKNOWNSQLEXCEPTION = 203;

    /**
     *
     */
    const USERMALFORMEDMEMBERSHIPID = 204;

    /**
     *
     */
    const USERCANNOTFINDREQUESTEDUSER = 205;

    /**
     *
     */
    const USERCANNOTLOADACCOUNTCREDENTIALLINKINFO = 206;

    /**
     *
     */
    const USERINVALIDMOBILEAPPTYPE = 207;

    /**
     *
     */
    const USERMISSINGMOBILEPAIRINGINFO = 208;

    /**
     *
     */
    const USERCANNOTGENERATEMOBILEKEYWHILEUSINGMOBILECREDENTIAL = 209;

    /**
     *
     */
    const USERGENERATEMOBILEKEYEXISTINGSLOTCOLLISION = 210;

    /**
     *
     */
    const USERDISPLAYNAMEMISSINGORINVALID = 211;

    /**
     *
     */
    const USERCANNOTLOADACCOUNTPROFILEDATA = 212;

    /**
     *
     */
    const USERCANNOTSAVEUSERPROFILEDATA = 213;

    /**
     *
     */
    const USEREMAILMISSINGORINVALID = 214;

    /**
     *
     */
    const USERTERMSOFUSEREQUIRED = 215;

    /**
     *
     */
    const USERCANNOTCREATENEWACCOUNTWHILELOGGEDIN = 216;

    /**
     *
     */
    const USERCANNOTRESOLVECENTRALACCOUNT = 217;

    /**
     *
     */
    const USERINVALIDAVATAR = 218;

    /**
     *
     */
    const USERMISSINGCREATEDUSERRESULT = 219;

    /**
     *
     */
    const USERCANNOTCHANGEUNIQUENAMEYET = 220;

    /**
     *
     */
    const USERCANNOTCHANGEDISPLAYNAMEYET = 221;

    /**
     *
     */
    const USERCANNOTCHANGEEMAIL = 222;

    /**
     *
     */
    const USERUNIQUENAMEMUSTSTARTWITHLETTER = 223;

    /**
     *
     */
    const USERNOLINKEDACCOUNTSSUPPORTFRIENDLISTINGS = 224;

    /**
     *
     */
    const USERACKNOWLEDGMENTTABLEFULL = 225;

    /**
     *
     */
    const USERCREATIONDESTINYMEMBERSHIPREQUIRED = 226;

    /**
     *
     */
    const USERFRIENDSTOKENNEEDSREFRESH = 227;

    /**
     *
     */
    const MESSAGINGUNKNOWNERROR = 300;

    /**
     *
     */
    const MESSAGINGSELFERROR = 301;

    /**
     *
     */
    const MESSAGINGSENDTHROTTLE = 302;

    /**
     *
     */
    const MESSAGINGNOBODY = 303;

    /**
     *
     */
    const MESSAGINGTOOMANYUSERS = 304;

    /**
     *
     */
    const MESSAGINGCANNOTLEAVECONVERSATION = 305;

    /**
     *
     */
    const MESSAGINGUNABLETOSEND = 306;

    /**
     *
     */
    const MESSAGINGDELETEDUSERFORBIDDEN = 307;

    /**
     *
     */
    const MESSAGINGCANNOTDELETEEXTERNALCONVERSATION = 308;

    /**
     *
     */
    const MESSAGINGGROUPCHATDISABLED = 309;

    /**
     *
     */
    const MESSAGINGMUSTINCLUDESELFINPRIVATEMESSAGE = 310;

    /**
     *
     */
    const MESSAGINGSENDERISBANNED = 311;

    /**
     *
     */
    const MESSAGINGGROUPOPTIONALCHATEXCEEDEDMAXIMUM = 312;

    /**
     *
     */
    const PRIVATEMESSAGINGREQUIRESDESTINYMEMBERSHIP = 313;

    /**
     *
     */
    const ADDSURVEYANSWERSUNKNOWNSQLEXCEPTION = 400;

    /**
     *
     */
    const FORUMBODYCANNOTBEEMPTY = 500;

    /**
     *
     */
    const FORUMSUBJECTCANNOTBEEMPTYONTOPICPOST = 501;

    /**
     *
     */
    const FORUMCANNOTLOCATEPARENTPOST = 502;

    /**
     *
     */
    const FORUMTHREADLOCKEDFORREPLIES = 503;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGCREATEPOST = 504;

    /**
     *
     */
    const FORUMUNKNOWNTAGCREATIONERROR = 505;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGTAGITEM = 506;

    /**
     *
     */
    const FORUMUNKNOWNEXCEPTIONCREATEPOST = 507;

    /**
     *
     */
    const FORUMQUESTIONMUSTBETOPICPOST = 508;

    /**
     *
     */
    const FORUMEXCEPTIONDURINGTAGSEARCH = 509;

    /**
     *
     */
    const FORUMEXCEPTIONDURINGTOPICRETRIEVAL = 510;

    /**
     *
     */
    const FORUMALIASEDTAGERROR = 511;

    /**
     *
     */
    const FORUMCANNOTLOCATETHREAD = 512;

    /**
     *
     */
    const FORUMUNKNOWNEXCEPTIONEDITPOST = 513;

    /**
     *
     */
    const FORUMCANNOTLOCATEPOST = 514;

    /**
     *
     */
    const FORUMUNKNOWNEXCEPTIONGETORCREATETAGS = 515;

    /**
     *
     */
    const FORUMEDITPERMISSIONDENIED = 516;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGTAGIDRETRIEVAL = 517;

    /**
     *
     */
    const FORUMCANNOTGETRATING = 518;

    /**
     *
     */
    const FORUMUNKNOWNEXCEPTIONGETRATING = 519;

    /**
     *
     */
    const FORUMRATINGSACCESSERROR = 520;

    /**
     *
     */
    const FORUMRELATEDPOSTACCESSERROR = 521;

    /**
     *
     */
    const FORUMLATESTREPLYACCESSERROR = 522;

    /**
     *
     */
    const FORUMUSERSTATUSACCESSERROR = 523;

    /**
     *
     */
    const FORUMAUTHORACCESSERROR = 524;

    /**
     *
     */
    const FORUMGROUPACCESSERROR = 525;

    /**
     *
     */
    const FORUMURLEXPECTEDBUTMISSING = 526;

    /**
     *
     */
    const FORUMREPLIESCANNOTBEEMPTY = 527;

    /**
     *
     */
    const FORUMREPLIESCANNOTBEINDIFFERENTGROUPS = 528;

    /**
     *
     */
    const FORUMSUBTOPICCANNOTBECREATEDATTHISTHREADLEVEL = 529;

    /**
     *
     */
    const FORUMCANNOTCREATECONTENTTOPIC = 530;

    /**
     *
     */
    const FORUMTOPICDOESNOTEXIST = 531;

    /**
     *
     */
    const FORUMCONTENTCOMMENTSNOTALLOWED = 532;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGEDITPOST = 533;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGGETPOST = 534;

    /**
     *
     */
    const FORUMPOSTVALIDATIONBADURL = 535;

    /**
     *
     */
    const FORUMBODYTOOLONG = 536;

    /**
     *
     */
    const FORUMSUBJECTTOOLONG = 537;

    /**
     *
     */
    const FORUMANNOUNCEMENTNOTALLOWED = 538;

    /**
     *
     */
    const FORUMCANNOTSHAREOWNPOST = 539;

    /**
     *
     */
    const FORUMEDITNOOP = 540;

    /**
     *
     */
    const FORUMUNKNOWNDATABASEERRORDURINGGETPOST = 541;

    /**
     *
     */
    const FORUMEXCEEEDMAXIMUMROWLIMIT = 542;

    /**
     *
     */
    const FORUMCANNOTSHAREPRIVATEPOST = 543;

    /**
     *
     */
    const FORUMCANNOTCROSSPOSTBETWEENGROUPS = 544;

    /**
     *
     */
    const FORUMINCOMPATIBLECATEGORIES = 555;

    /**
     *
     */
    const FORUMCANNOTUSETHESECATEGORIESONNONTOPICPOST = 556;

    /**
     *
     */
    const FORUMCANONLYDELETETOPICS = 557;

    /**
     *
     */
    const FORUMDELETESQLEXCEPTION = 558;

    /**
     *
     */
    const FORUMDELETESQLUNKNOWNRESULT = 559;

    /**
     *
     */
    const FORUMTOOMANYTAGS = 560;

    /**
     *
     */
    const FORUMCANONLYRATETOPICS = 561;

    /**
     *
     */
    const FORUMBANNEDPOSTSCANNOTBEEDITED = 562;

    /**
     *
     */
    const FORUMTHREADROOTISBANNED = 563;

    /**
     *
     */
    const FORUMCANNOTUSEOFFICIALTAGCATEGORYASTAG = 564;

    /**
     *
     */
    const FORUMANSWERCANNOTBEMADEONCREATEPOST = 565;

    /**
     *
     */
    const FORUMANSWERCANNOTBEMADEONEDITPOST = 566;

    /**
     *
     */
    const FORUMANSWERPOSTIDISNOTADIRECTREPLYOFQUESTION = 567;

    /**
     *
     */
    const FORUMANSWERTOPICIDISNOTAQUESTION = 568;

    /**
     *
     */
    const FORUMUNKNOWNEXCEPTIONDURINGMARKANSWER = 569;

    /**
     *
     */
    const FORUMUNKNOWNSQLRESULTDURINGMARKANSWER = 570;

    /**
     *
     */
    const FORUMCANNOTRATEYOUROWNPOSTS = 571;

    /**
     *
     */
    const FORUMPOLLSMUSTBETHEFIRSTPOSTINTOPIC = 572;

    /**
     *
     */
    const FORUMINVALIDPOLLINPUT = 573;

    /**
     *
     */
    const FORUMGROUPADMINEDITNONMEMBER = 574;

    /**
     *
     */
    const FORUMCANNOTEDITMODERATOREDITEDPOST = 575;

    /**
     *
     */
    const FORUMREQUIRESDESTINYMEMBERSHIP = 576;

    /**
     *
     */
    const FORUMUNEXPECTEDERROR = 577;

    /**
     *
     */
    const FORUMAGELOCK = 578;

    /**
     *
     */
    const FORUMMAXPAGES = 579;

    /**
     *
     */
    const FORUMMAXPAGESOLDESTFIRST = 580;

    /**
     *
     */
    const FORUMCANNOTAPPLYFORUMIDWITHOUTTAGS = 581;

    /**
     *
     */
    const FORUMCANNOTAPPLYFORUMIDTONONTOPICS = 582;

    /**
     *
     */
    const FORUMCANNOTDOWNVOTECOMMUNITYCREATIONS = 583;

    /**
     *
     */
    const FORUMTOPICSMUSTHAVEOFFICIALCATEGORY = 584;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICMALFORMED = 585;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICNOTFOUND = 586;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICNOSLOTSREMAINING = 587;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICKICKBAN = 588;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICREQUIREMENTSNOTMET = 589;

    /**
     *
     */
    const FORUMRECRUITMENTTOPICNOPLAYERS = 590;

    /**
     *
     */
    const FORUMRECRUITMENTAPPROVEFAILMESSAGEBAN = 591;

    /**
     *
     */
    const FORUMRECRUITMENTGLOBALBAN = 592;

    /**
     *
     */
    const FORUMUSERBANNEDFROMTHISTOPIC = 593;

    /**
     *
     */
    const FORUMRECRUITMENTFIRETEAMMEMBERSONLY = 594;

    /**
     *
     */
    const FORUMREQUIRESDESTINY2PROGRESS = 595;

    /**
     *
     */
    const GROUPMEMBERSHIPAPPLICATIONALREADYRESOLVED = 601;

    /**
     *
     */
    const GROUPMEMBERSHIPALREADYAPPLIED = 602;

    /**
     *
     */
    const GROUPMEMBERSHIPINSUFFICIENTPRIVILEGES = 603;

    /**
     *
     */
    const GROUPIDNOTRETURNEDFROMCREATION = 604;

    /**
     *
     */
    const GROUPSEARCHINVALIDPARAMETERS = 605;

    /**
     *
     */
    const GROUPMEMBERSHIPPENDINGAPPLICATIONNOTFOUND = 606;

    /**
     *
     */
    const GROUPINVALIDID = 607;

    /**
     *
     */
    const GROUPINVALIDMEMBERSHIPID = 608;

    /**
     *
     */
    const GROUPINVALIDMEMBERSHIPTYPE = 609;

    /**
     *
     */
    const GROUPMISSINGTAGS = 610;

    /**
     *
     */
    const GROUPMEMBERSHIPNOTFOUND = 611;

    /**
     *
     */
    const GROUPINVALIDRATING = 612;

    /**
     *
     */
    const GROUPUSERFOLLOWINGACCESSERROR = 613;

    /**
     *
     */
    const GROUPUSERMEMBERSHIPACCESSERROR = 614;

    /**
     *
     */
    const GROUPCREATORACCESSERROR = 615;

    /**
     *
     */
    const GROUPADMINACCESSERROR = 616;

    /**
     *
     */
    const GROUPPRIVATEPOSTNOTVIEWABLE = 617;

    /**
     *
     */
    const GROUPMEMBERSHIPNOTLOGGEDIN = 618;

    /**
     *
     */
    const GROUPNOTDELETED = 619;

    /**
     *
     */
    const GROUPUNKNOWNERRORUNDELETINGGROUP = 620;

    /**
     *
     */
    const GROUPDELETED = 621;

    /**
     *
     */
    const GROUPNOTFOUND = 622;

    /**
     *
     */
    const GROUPMEMBERBANNED = 623;

    /**
     *
     */
    const GROUPMEMBERSHIPCLOSED = 624;

    /**
     *
     */
    const GROUPPRIVATEPOSTOVERRIDEERROR = 625;

    /**
     *
     */
    const GROUPNAMETAKEN = 626;

    /**
     *
     */
    const GROUPDELETIONGRACEPERIODEXPIRED = 627;

    /**
     *
     */
    const GROUPCANNOTCHECKBANSTATUS = 628;

    /**
     *
     */
    const GROUPMAXIMUMMEMBERSHIPCOUNTREACHED = 629;

    /**
     *
     */
    const NODESTINYACCOUNTFORCLANPLATFORM = 630;

    /**
     *
     */
    const ALREADYREQUESTINGMEMBERSHIPFORCLANPLATFORM = 631;

    /**
     *
     */
    const ALREADYCLANMEMBERONPLATFORM = 632;

    /**
     *
     */
    const GROUPJOINEDCANNOTSETCLANNAME = 633;

    /**
     *
     */
    const GROUPLEFTCANNOTCLEARCLANNAME = 634;

    /**
     *
     */
    const GROUPRELATIONSHIPREQUESTPENDING = 635;

    /**
     *
     */
    const GROUPRELATIONSHIPREQUESTBLOCKED = 636;

    /**
     *
     */
    const GROUPRELATIONSHIPREQUESTNOTFOUND = 637;

    /**
     *
     */
    const GROUPRELATIONSHIPBLOCKNOTFOUND = 638;

    /**
     *
     */
    const GROUPRELATIONSHIPNOTFOUND = 639;

    /**
     *
     */
    const GROUPALREADYALLIED = 641;

    /**
     *
     */
    const GROUPALREADYMEMBER = 642;

    /**
     *
     */
    const GROUPRELATIONSHIPALREADYEXISTS = 643;

    /**
     *
     */
    const INVALIDGROUPTYPESFORRELATIONSHIPREQUEST = 644;

    /**
     *
     */
    const GROUPATMAXIMUMALLIANCES = 646;

    /**
     *
     */
    const GROUPCANNOTSETCLANONLYSETTINGS = 647;

    /**
     *
     */
    const CLANCANNOTSETTWODEFAULTPOSTTYPES = 648;

    /**
     *
     */
    const GROUPMEMBERINVALIDMEMBERTYPE = 649;

    /**
     *
     */
    const GROUPINVALIDPLATFORMTYPE = 650;

    /**
     *
     */
    const GROUPMEMBERINVALIDSORT = 651;

    /**
     *
     */
    const GROUPINVALIDRESOLVESTATE = 652;

    /**
     *
     */
    const CLANALREADYENABLEDFORPLATFORM = 653;

    /**
     *
     */
    const CLANNOTENABLEDFORPLATFORM = 654;

    /**
     *
     */
    const CLANENABLEDBUTCOULDNOTJOINNOACCOUNT = 655;

    /**
     *
     */
    const CLANENABLEDBUTCOULDNOTJOINALREADYMEMBER = 656;

    /**
     *
     */
    const CLANCANNOTJOINNOCREDENTIAL = 657;

    /**
     *
     */
    const NOCLANMEMBERSHIPFORPLATFORM = 658;

    /**
     *
     */
    const GROUPTOGROUPFOLLOWLIMITREACHED = 659;

    /**
     *
     */
    const CHILDGROUPALREADYINALLIANCE = 660;

    /**
     *
     */
    const OWNERGROUPALREADYINALLIANCE = 661;

    /**
     *
     */
    const ALLIANCEOWNERCANNOTJOINALLIANCE = 662;

    /**
     *
     */
    const GROUPNOTINALLIANCE = 663;

    /**
     *
     */
    const CHILDGROUPCANNOTINVITETOALLIANCE = 664;

    /**
     *
     */
    const GROUPTOGROUPALREADYFOLLOWED = 665;

    /**
     *
     */
    const GROUPTOGROUPNOTFOLLOWING = 666;

    /**
     *
     */
    const CLANMAXIMUMMEMBERSHIPREACHED = 667;

    /**
     *
     */
    const CLANNAMENOTVALID = 668;

    /**
     *
     */
    const CLANNAMENOTVALIDERROR = 669;

    /**
     *
     */
    const ALLIANCEOWNERNOTDEFINED = 670;

    /**
     *
     */
    const ALLIANCECHILDNOTDEFINED = 671;

    /**
     *
     */
    const CLANCULTUREILLEGALCHARACTERS = 672;

    /**
     *
     */
    const CLANTAGILLEGALCHARACTERS = 673;

    /**
     *
     */
    const CLANREQUIRESINVITATION = 674;

    /**
     *
     */
    const CLANMEMBERSHIPCLOSED = 675;

    /**
     *
     */
    const CLANINVITEALREADYMEMBER = 676;

    /**
     *
     */
    const GROUPINVITEALREADYMEMBER = 677;

    /**
     *
     */
    const GROUPJOINAPPROVALREQUIRED = 678;

    /**
     *
     */
    const CLANTAGREQUIRED = 679;

    /**
     *
     */
    const GROUPNAMECANNOTSTARTORENDWITHWHITESPACE = 680;

    /**
     *
     */
    const CLANCALLSIGNCANNOTSTARTORENDWITHWHITESPACE = 681;

    /**
     *
     */
    const CLANMIGRATIONFAILED = 682;

    /**
     *
     */
    const CLANNOTENABLEDALREADYMEMBEROFANOTHERCLAN = 683;

    /**
     *
     */
    const GROUPMODERATIONNOTPERMITTEDONNONMEMBERS = 684;

    /**
     *
     */
    const CLANCREATIONINWORLDSERVERFAILED = 685;

    /**
     *
     */
    const CLANNOTFOUND = 686;

    /**
     *
     */
    const CLANMEMBERSHIPLEVELDOESNOTPERMITTHATACTION = 687;

    /**
     *
     */
    const CLANMEMBERNOTFOUND = 688;

    /**
     *
     */
    const CLANMISSINGMEMBERSHIPAPPROVERS = 689;

    /**
     *
     */
    const CLANINWRONGSTATEFORREQUESTEDACTION = 690;

    /**
     *
     */
    const CLANNAMEALREADYUSED = 691;

    /**
     *
     */
    const CLANTOOFEWMEMBERS = 692;

    /**
     *
     */
    const CLANINFOCANNOTBEWHITESPACE = 693;

    /**
     *
     */
    const GROUPCULTURETHROTTLE = 694;

    /**
     *
     */
    const CLANTARGETDISALLOWSINVITES = 695;

    /**
     *
     */
    const CLANINVALIDOPERATION = 696;

    /**
     *
     */
    const CLANFOUNDERCANNOTLEAVEWITHOUTABDICATION = 697;

    /**
     *
     */
    const CLANNAMERESERVED = 698;

    /**
     *
     */
    const CLANAPPLICANTINCLANSONOWINVITED = 699;

    /**
     *
     */
    const ACTIVITIESUNKNOWNEXCEPTION = 701;

    /**
     *
     */
    const ACTIVITIESPARAMETERNULL = 702;

    /**
     *
     */
    const ACTIVITYCOUNTSDIABLED = 703;

    /**
     *
     */
    const ACTIVITYSEARCHINVALIDPARAMETERS = 704;

    /**
     *
     */
    const ACTIVITYPERMISSIONDENIED = 705;

    /**
     *
     */
    const SHAREALREADYSHARED = 706;

    /**
     *
     */
    const ACTIVITYLOGGINGDISABLED = 707;

    /**
     *
     */
    const CLANREQUIRESEXISTINGDESTINYACCOUNT = 750;

    /**
     *
     */
    const ITEMALREADYFOLLOWED = 801;

    /**
     *
     */
    const ITEMNOTFOLLOWED = 802;

    /**
     *
     */
    const CANNOTFOLLOWSELF = 803;

    /**
     *
     */
    const GROUPFOLLOWLIMITEXCEEDED = 804;

    /**
     *
     */
    const TAGFOLLOWLIMITEXCEEDED = 805;

    /**
     *
     */
    const USERFOLLOWLIMITEXCEEDED = 806;

    /**
     *
     */
    const FOLLOWUNSUPPORTEDENTITYTYPE = 807;

    /**
     *
     */
    const NOVALIDTAGSINLIST = 900;

    /**
     *
     */
    const BELOWMINIMUMSUGGESTIONLENGTH = 901;

    /**
     *
     */
    const CANNOTGETSUGGESTIONSONMULTIPLETAGSSIMULTANEOUSLY = 902;

    /**
     *
     */
    const NOTAVALIDPARTIALTAG = 903;

    /**
     *
     */
    const TAGSUGGESTIONSUNKNOWNSQLRESULT = 904;

    /**
     *
     */
    const TAGSUNABLETOLOADPOPULARTAGSFROMDATABASE = 905;

    /**
     *
     */
    const TAGINVALID = 906;

    /**
     *
     */
    const TAGNOTFOUND = 907;

    /**
     *
     */
    const SINGLETAGEXPECTED = 908;

    /**
     *
     */
    const TAGSEXCEEDEDMAXIMUMPERITEM = 909;

    /**
     *
     */
    const IGNOREINVALIDPARAMETERS = 1000;

    /**
     *
     */
    const IGNORESQLEXCEPTION = 1001;

    /**
     *
     */
    const IGNOREERRORRETRIEVINGGROUPPERMISSIONS = 1002;

    /**
     *
     */
    const IGNOREERRORINSUFFICIENTPERMISSION = 1003;

    /**
     *
     */
    const IGNOREERRORRETRIEVINGITEM = 1004;

    /**
     *
     */
    const IGNORECANNOTIGNORESELF = 1005;

    /**
     *
     */
    const IGNOREILLEGALTYPE = 1006;

    /**
     *
     */
    const IGNORENOTFOUND = 1007;

    /**
     *
     */
    const IGNOREUSERGLOBALLYIGNORED = 1008;

    /**
     *
     */
    const IGNOREUSERIGNORED = 1009;

    /**
     *
     */
    const NOTIFICATIONSETTINGINVALID = 1100;

    /**
     *
     */
    const PSNAPIEXPIREDACCESSTOKEN = 1204;

    /**
     *
     */
    const PSNEXFORBIDDEN = 1205;

    /**
     *
     */
    const PSNEXSYSTEMDISABLED = 1218;

    /**
     *
     */
    const PSNAPIERRORCODEUNKNOWN = 1223;

    /**
     *
     */
    const PSNAPIERRORWEBEXCEPTION = 1224;

    /**
     *
     */
    const PSNAPIBADREQUEST = 1225;

    /**
     *
     */
    const PSNAPIACCESSTOKENREQUIRED = 1226;

    /**
     *
     */
    const PSNAPIINVALIDACCESSTOKEN = 1227;

    /**
     *
     */
    const PSNAPIBANNEDUSER = 1229;

    /**
     *
     */
    const PSNAPIACCOUNTUPGRADEREQUIRED = 1230;

    /**
     *
     */
    const PSNAPISERVICETEMPORARILYUNAVAILABLE = 1231;

    /**
     *
     */
    const PSNAPISERVERBUSY = 1232;

    /**
     *
     */
    const PSNAPIUNDERMAINTENANCE = 1233;

    /**
     *
     */
    const PSNAPIPROFILEUSERNOTFOUND = 1234;

    /**
     *
     */
    const PSNAPIPROFILEPRIVACYRESTRICTION = 1235;

    /**
     *
     */
    const PSNAPIPROFILEUNDERMAINTENANCE = 1236;

    /**
     *
     */
    const PSNAPIACCOUNTATTRIBUTEMISSING = 1237;

    /**
     *
     */
    const PSNAPINOPERMISSION = 1238;

    /**
     *
     */
    const PSNAPITARGETUSERBLOCKED = 1239;

    /**
     *
     */
    const XBLEXSYSTEMDISABLED = 1300;

    /**
     *
     */
    const XBLEXUNKNOWNERROR = 1301;

    /**
     *
     */
    const XBLAPIERRORWEBEXCEPTION = 1302;

    /**
     *
     */
    const XBLSTSTOKENINVALID = 1303;

    /**
     *
     */
    const XBLSTSMISSINGTOKEN = 1304;

    /**
     *
     */
    const XBLSTSEXPIREDTOKEN = 1305;

    /**
     *
     */
    const XBLACCESSTOTHESANDBOXDENIED = 1306;

    /**
     *
     */
    const XBLMSARESPONSEMISSING = 1307;

    /**
     *
     */
    const XBLMSAACCESSTOKENEXPIRED = 1308;

    /**
     *
     */
    const XBLMSAINVALIDREQUEST = 1309;

    /**
     *
     */
    const XBLMSAFRIENDSREQUIRESIGNIN = 1310;

    /**
     *
     */
    const XBLUSERACTIONREQUIRED = 1311;

    /**
     *
     */
    const XBLPARENTALCONTROLS = 1312;

    /**
     *
     */
    const XBLDEVELOPERACCOUNT = 1313;

    /**
     *
     */
    const XBLUSERTOKENEXPIRED = 1314;

    /**
     *
     */
    const XBLUSERTOKENINVALID = 1315;

    /**
     *
     */
    const XBLOFFLINE = 1316;

    /**
     *
     */
    const XBLUNKNOWNERRORCODE = 1317;

    /**
     *
     */
    const XBLMSAINVALIDGRANT = 1318;

    /**
     *
     */
    const REPORTNOTYETRESOLVED = 1400;

    /**
     *
     */
    const REPORTOVERTURNDOESNOTCHANGEDECISION = 1401;

    /**
     *
     */
    const REPORTNOTFOUND = 1402;

    /**
     *
     */
    const REPORTALREADYREPORTED = 1403;

    /**
     *
     */
    const REPORTINVALIDRESOLUTION = 1404;

    /**
     *
     */
    const REPORTNOTASSIGNEDTOYOU = 1405;

    /**
     *
     */
    const LEGACYGAMESTATSSYSTEMDISABLED = 1500;

    /**
     *
     */
    const LEGACYGAMESTATSUNKNOWNERROR = 1501;

    /**
     *
     */
    const LEGACYGAMESTATSMALFORMEDSNEAKERNETCODE = 1502;

    /**
     *
     */
    const DESTINYACCOUNTACQUISITIONFAILURE = 1600;

    /**
     *
     */
    const DESTINYACCOUNTNOTFOUND = 1601;

    /**
     *
     */
    const DESTINYBUILDSTATSDATABASEERROR = 1602;

    /**
     *
     */
    const DESTINYCHARACTERSTATSDATABASEERROR = 1603;

    /**
     *
     */
    const DESTINYPVPSTATSDATABASEERROR = 1604;

    /**
     *
     */
    const DESTINYPVESTATSDATABASEERROR = 1605;

    /**
     *
     */
    const DESTINYGRIMOIRESTATSDATABASEERROR = 1606;

    /**
     *
     */
    const DESTINYSTATSPARAMETERMEMBERSHIPTYPEPARSEERROR = 1607;

    /**
     *
     */
    const DESTINYSTATSPARAMETERMEMBERSHIPIDPARSEERROR = 1608;

    /**
     *
     */
    const DESTINYSTATSPARAMETERRANGEPARSEERROR = 1609;

    /**
     *
     */
    const DESTINYSTRINGITEMHASHNOTFOUND = 1610;

    /**
     *
     */
    const DESTINYSTRINGSETNOTFOUND = 1611;

    /**
     *
     */
    const DESTINYCONTENTLOOKUPNOTFOUNDFORKEY = 1612;

    /**
     *
     */
    const DESTINYCONTENTITEMNOTFOUND = 1613;

    /**
     *
     */
    const DESTINYCONTENTSECTIONNOTFOUND = 1614;

    /**
     *
     */
    const DESTINYCONTENTPROPERTYNOTFOUND = 1615;

    /**
     *
     */
    const DESTINYCONTENTCONFIGNOTFOUND = 1616;

    /**
     *
     */
    const DESTINYCONTENTPROPERTYBUCKETVALUENOTFOUND = 1617;

    /**
     *
     */
    const DESTINYUNEXPECTEDERROR = 1618;

    /**
     *
     */
    const DESTINYINVALIDACTION = 1619;

    /**
     *
     */
    const DESTINYCHARACTERNOTFOUND = 1620;

    /**
     *
     */
    const DESTINYINVALIDFLAG = 1621;

    /**
     *
     */
    const DESTINYINVALIDREQUEST = 1622;

    /**
     *
     */
    const DESTINYITEMNOTFOUND = 1623;

    /**
     *
     */
    const DESTINYINVALIDCUSTOMIZATIONCHOICES = 1624;

    /**
     *
     */
    const DESTINYVENDORITEMNOTFOUND = 1625;

    /**
     *
     */
    const DESTINYINTERNALERROR = 1626;

    /**
     *
     */
    const DESTINYVENDORNOTFOUND = 1627;

    /**
     *
     */
    const DESTINYRECENTACTIVITIESDATABASEERROR = 1628;

    /**
     *
     */
    const DESTINYITEMBUCKETNOTFOUND = 1629;

    /**
     *
     */
    const DESTINYINVALIDMEMBERSHIPTYPE = 1630;

    /**
     *
     */
    const DESTINYVERSIONINCOMPATIBILITY = 1631;

    /**
     *
     */
    const DESTINYITEMALREADYININVENTORY = 1632;

    /**
     *
     */
    const DESTINYBUCKETNOTFOUND = 1633;

    /**
     *
     */
    const DESTINYCHARACTERNOTINTOWER = 1634; // Note: This is one of those holdovers from Destiny 1. We didn't change the enum because I am lazy, but in Destiny 2 this would read "DestinyCharacterNotInSocialSpace"

    /**
     *
     */
    const DESTINYCHARACTERNOTLOGGEDIN = 1635;

    /**
     *
     */
    const DESTINYDEFINITIONSNOTLOADED = 1636;

    /**
     *
     */
    const DESTINYINVENTORYFULL = 1637;

    /**
     *
     */
    const DESTINYITEMFAILEDLEVELCHECK = 1638;

    /**
     *
     */
    const DESTINYITEMFAILEDUNLOCKCHECK = 1639;

    /**
     *
     */
    const DESTINYITEMUNEQUIPPABLE = 1640;

    /**
     *
     */
    const DESTINYITEMUNIQUEEQUIPRESTRICTED = 1641;

    /**
     *
     */
    const DESTINYNOROOMINDESTINATION = 1642;

    /**
     *
     */
    const DESTINYSERVICEFAILURE = 1643;

    /**
     *
     */
    const DESTINYSERVICERETIRED = 1644;

    /**
     *
     */
    const DESTINYTRANSFERFAILED = 1645;

    /**
     *
     */
    const DESTINYTRANSFERNOTFOUNDFORSOURCEBUCKET = 1646;

    /**
     *
     */
    const DESTINYUNEXPECTEDRESULTINVENDORTRANSFERCHECK = 1647;

    /**
     *
     */
    const DESTINYUNIQUENESSVIOLATION = 1648;

    /**
     *
     */
    const DESTINYERRORDESERIALIZATIONFAILURE = 1649;

    /**
     *
     */
    const DESTINYVALIDACCOUNTTICKETREQUIRED = 1650;

    /**
     *
     */
    const DESTINYSHARDRELAYCLIENTTIMEOUT = 1651;

    /**
     *
     */
    const DESTINYSHARDRELAYPROXYTIMEOUT = 1652;

    /**
     *
     */
    const DESTINYPGCRNOTFOUND = 1653;

    /**
     *
     */
    const DESTINYACCOUNTMUSTBEOFFLINE = 1654;

    /**
     *
     */
    const DESTINYCANONLYEQUIPINGAME = 1655;

    /**
     *
     */
    const DESTINYCANNOTPERFORMACTIONONEQUIPPEDITEM = 1656;

    /**
     *
     */
    const DESTINYQUESTALREADYCOMPLETED = 1657;

    /**
     *
     */
    const DESTINYQUESTALREADYTRACKED = 1658;

    /**
     *
     */
    const DESTINYTRACKABLEQUESTSFULL = 1659;

    /**
     *
     */
    const DESTINYITEMNOTTRANSFERRABLE = 1660;

    /**
     *
     */
    const DESTINYVENDORPURCHASENOTALLOWED = 1661;

    /**
     *
     */
    const DESTINYCONTENTVERSIONMISMATCH = 1662;

    /**
     *
     */
    const DESTINYITEMACTIONFORBIDDEN = 1663;

    /**
     *
     */
    const DESTINYREFUNDINVALID = 1664;

    /**
     *
     */
    const DESTINYPRIVACYRESTRICTION = 1665;

    /**
     *
     */
    const DESTINYACTIONINSUFFICIENTPRIVILEGES = 1666;

    /**
     *
     */
    const DESTINYINVALIDCLAIMEXCEPTION = 1667;

    /**
     *
     */
    const DESTINYLEGACYPLATFORMRESTRICTED = 1668;

    /**
     *
     */
    const DESTINYLEGACYPLATFORMINUSE = 1669;

    /**
     *
     */
    const DESTINYLEGACYPLATFORMINACCESSIBLE = 1670;

    /**
     *
     */
    const DESTINYCANNOTPERFORMACTIONATTHISLOCATION = 1671;

    /**
     *
     */
    const DESTINYTHROTTLEDBYGAMESERVER = 1672;

    /**
     *
     */
    const DESTINYITEMNOTTRANSFERRABLEHASSIDEEFFECTS = 1673;

    /**
     *
     */
    const DESTINYITEMLOCKED = 1674;

    /**
     *
     */
    const DESTINYCANNOTAFFORDMATERIALREQUIREMENTS = 1675;

    /**
     *
     */
    const DESTINYFAILEDPLUGINSERTIONRULES = 1676;

    /**
     *
     */
    const DESTINYSOCKETNOTFOUND = 1677;

    /**
     *
     */
    const DESTINYSOCKETACTIONNOTALLOWED = 1678;

    /**
     *
     */
    const DESTINYSOCKETALREADYHASPLUG = 1679;

    /**
     *
     */
    const DESTINYPLUGITEMNOTAVAILABLE = 1680;

    /**
     *
     */
    const DESTINYCHARACTERLOGGEDINNOTALLOWED = 1681;

    /**
     *
     */
    const DESTINYPUBLICACCOUNTNOTACCESSIBLE = 1682;

    /**
     *
     */
    const FBINVALIDREQUEST = 1800;

    /**
     *
     */
    const FBREDIRECTMISMATCH = 1801;

    /**
     *
     */
    const FBACCESSDENIED = 1802;

    /**
     *
     */
    const FBUNSUPPORTEDRESPONSETYPE = 1803;

    /**
     *
     */
    const FBINVALIDSCOPE = 1804;

    /**
     *
     */
    const FBUNSUPPORTEDGRANTTYPE = 1805;

    /**
     *
     */
    const FBINVALIDGRANT = 1806;

    /**
     *
     */
    const INVITATIONEXPIRED = 1900;

    /**
     *
     */
    const INVITATIONUNKNOWNTYPE = 1901;

    /**
     *
     */
    const INVITATIONINVALIDRESPONSESTATUS = 1902;

    /**
     *
     */
    const INVITATIONINVALIDTYPE = 1903;

    /**
     *
     */
    const INVITATIONALREADYPENDING = 1904;

    /**
     *
     */
    const INVITATIONINSUFFICIENTPERMISSION = 1905;

    /**
     *
     */
    const INVITATIONINVALIDCODE = 1906;

    /**
     *
     */
    const INVITATIONINVALIDTARGETSTATE = 1907;

    /**
     *
     */
    const INVITATIONCANNOTBEREACTIVATED = 1908;

    /**
     *
     */
    const INVITATIONNORECIPIENTS = 1910;

    /**
     *
     */
    const INVITATIONGROUPCANNOTSENDTOSELF = 1911;

    /**
     *
     */
    const INVITATIONTOOMANYRECIPIENTS = 1912;

    /**
     *
     */
    const INVITATIONINVALID = 1913;

    /**
     *
     */
    const INVITATIONNOTFOUND = 1914;

    /**
     *
     */
    const TOKENINVALID = 2000;

    /**
     *
     */
    const TOKENBADFORMAT = 2001;

    /**
     *
     */
    const TOKENALREADYCLAIMED = 2002;

    /**
     *
     */
    const TOKENALREADYCLAIMEDSELF = 2003;

    /**
     *
     */
    const TOKENTHROTTLING = 2004;

    /**
     *
     */
    const TOKENUNKNOWNREDEMPTIONFAILURE = 2005;

    /**
     *
     */
    const TOKENPURCHASECLAIMFAILEDAFTERTOKENCLAIMED = 2006;

    /**
     *
     */
    const TOKENUSERALREADYOWNSOFFER = 2007;

    /**
     *
     */
    const TOKENINVALIDOFFERKEY = 2008;

    /**
     *
     */
    const TOKENEMAILNOTVALIDATED = 2009;

    /**
     *
     */
    const TOKENPROVISIONINGBADVENDOROROFFER = 2010;

    /**
     *
     */
    const TOKENPURCHASEHISTORYUNKNOWNERROR = 2011;

    /**
     *
     */
    const TOKENTHROTTLESTATEUNKNOWNERROR = 2012;

    /**
     *
     */
    const TOKENUSERAGENOTVERIFIED = 2013;

    /**
     *
     */
    const TOKENEXCEEDEDOFFERMAXIMUM = 2014;

    /**
     *
     */
    const TOKENNOAVAILABLEUNLOCKS = 2015;

    /**
     *
     */
    const TOKENMARKETPLACEINVALIDPLATFORM = 2016;

    /**
     *
     */
    const TOKENNOMARKETPLACECODESFOUND = 2017;

    /**
     *
     */
    const TOKENOFFERNOTAVAILABLEFORREDEMPTION = 2018;

    /**
     *
     */
    const TOKENUNLOCKPARTIALFAILURE = 2019;

    /**
     *
     */
    const TOKENMARKETPLACEINVALIDREGION = 2020;

    /**
     *
     */
    const TOKENOFFEREXPIRED = 2021;

    /**
     *
     */
    const RAFEXCEEDEDMAXIMUMREFERRALS = 2022;

    /**
     *
     */
    const RAFDUPLICATEBOND = 2023;

    /**
     *
     */
    const RAFNOVALIDVETERANDESTINYMEMBERSHIPSFOUND = 2024;

    /**
     *
     */
    const RAFNOTAVALIDVETERANUSER = 2025;

    /**
     *
     */
    const RAFCODEALREADYCLAIMEDORNOTFOUND = 2026;

    /**
     *
     */
    const RAFMISMATCHEDDESTINYMEMBERSHIPTYPE = 2027;

    /**
     *
     */
    const RAFUNABLETOACCESSPURCHASEHISTORY = 2028;

    /**
     *
     */
    const RAFUNABLETOCREATEBOND = 2029;

    /**
     *
     */
    const RAFUNABLETOFINDBOND = 2030;

    /**
     *
     */
    const RAFUNABLETOREMOVEBOND = 2031;

    /**
     *
     */
    const RAFCANNOTBONDTOSELF = 2032;

    /**
     *
     */
    const RAFINVALIDPLATFORM = 2033;

    /**
     *
     */
    const RAFGENERATETHROTTLED = 2034;

    /**
     *
     */
    const RAFUNABLETOCREATEBONDVERSIONMISMATCH = 2035;

    /**
     *
     */
    const RAFUNABLETOREMOVEBONDVERSIONMISMATCH = 2036;

    /**
     *
     */
    const RAFREDEEMTHROTTLED = 2037;

    /**
     *
     */
    const NOAVAILABLEDISCOUNTCODE = 2038;

    /**
     *
     */
    const DISCOUNTALREADYCLAIMED = 2039;

    /**
     *
     */
    const DISCOUNTCLAIMFAILURE = 2040;

    /**
     *
     */
    const DISCOUNTCONFIGURATIONFAILURE = 2041;

    /**
     *
     */
    const DISCOUNTGENERATIONFAILURE = 2042;

    /**
     *
     */
    const DISCOUNTALREADYEXISTS = 2043;

    /**
     *
     */
    const TOKENREQUIRESCREDENTIALXUID = 2044;

    /**
     *
     */
    const TOKENREQUIRESCREDENTIALPSNID = 2045;

    /**
     *
     */
    const OFFERREQUIRED = 2046;

    /**
     *
     */
    const UNKNOWNEVERVERSEHISTORYERROR = 2047;

    /**
     *
     */
    const MISSINGEVERVERSEHISTORYERROR = 2048;

    /**
     *
     */
    const BUNGIEREWARDEMAILSTATEINVALID = 2049;

    /**
     *
     */
    const BUNGIEREWARDNOTYETCLAIMABLE = 2050;

    /**
     *
     */
    const MISSINGOFFERCONFIG = 2051;

    /**
     *
     */
    const RAFQUESTENTITLEMENTREQUIRESBNET = 2052;

    /**
     *
     */
    const RAFQUESTENTITLEMENTTRANSPORTFAILURE = 2053;

    /**
     *
     */
    const RAFQUESTENTITLEMENTUNKNOWNFAILURE = 2054;

    /**
     *
     */
    const RAFVETERANREWARDUNKNOWNFAILURE = 2055;

    /**
     *
     */
    const RAFTOOEARLYTOCANCELBOND = 2056;

    /**
     *
     */
    const APIEXCEEDEDMAXKEYS = 2100;

    /**
     *
     */
    const APIINVALIDOREXPIREDKEY = 2101;

    /**
     *
     */
    const APIKEYMISSINGFROMREQUEST = 2102;

    /**
     *
     */
    const APPLICATIONDISABLED = 2103;

    /**
     *
     */
    const APPLICATIONEXCEEDEDMAX = 2104;

    /**
     *
     */
    const APPLICATIONDISALLOWEDBYSCOPE = 2105;

    /**
     *
     */
    const AUTHORIZATIONCODEINVALID = 2106;

    /**
     *
     */
    const ORIGINHEADERDOESNOTMATCHKEY = 2107;

    /**
     *
     */
    const ACCESSNOTPERMITTEDBYAPPLICATIONSCOPE = 2108;

    /**
     *
     */
    const APPLICATIONNAMEISTAKEN = 2109;

    /**
     *
     */
    const REFRESHTOKENNOTYETVALID = 2110;

    /**
     *
     */
    const ACCESSTOKENHASEXPIRED = 2111;

    /**
     *
     */
    const APPLICATIONTOKENFORMATNOTVALID = 2112;

    /**
     *
     */
    const APPLICATIONNOTCONFIGUREDFORBUNGIEAUTH = 2113;

    /**
     *
     */
    const APPLICATIONNOTCONFIGUREDFOROAUTH = 2114;

    /**
     *
     */
    const OAUTHACCESSTOKENEXPIRED = 2115;

    /**
     *
     */
    const PARTNERSHIPINVALIDTYPE = 2200;

    /**
     *
     */
    const PARTNERSHIPVALIDATIONERROR = 2201;

    /**
     *
     */
    const PARTNERSHIPVALIDATIONTIMEOUT = 2202;

    /**
     *
     */
    const PARTNERSHIPACCESSFAILURE = 2203;

    /**
     *
     */
    const PARTNERSHIPACCOUNTINVALID = 2204;

    /**
     *
     */
    const PARTNERSHIPGETACCOUNTINFOFAILURE = 2205;

    /**
     *
     */
    const PARTNERSHIPDISABLED = 2206;

    /**
     *
     */
    const PARTNERSHIPALREADYEXISTS = 2207;

    /**
     *
     */
    const COMMUNITYSTREAMINGUNAVAILABLE = 2300;

    /**
     *
     */
    const TWITCHNOTLINKED = 2500;

    /**
     *
     */
    const TWITCHACCOUNTNOTFOUND = 2501;

    /**
     *
     */
    const TWITCHCOULDNOTLOADDESTINYINFO = 2502;

    /**
     *
     */
    const TRENDINGCATEGORYNOTFOUND = 2600;

    /**
     *
     */
    const TRENDINGENTRYTYPENOTSUPPORTED = 2601;

    /**
     *
     */
    const REPORTOFFENDERNOTINPGCR = 2700;

    /**
     *
     */
    const REPORTREQUESTORNOTINPGCR = 2701;

    /**
     *
     */
    const REPORTSUBMISSIONFAILED = 2702;

    /**
     *
     */
    const REPORTCANNOTREPORTSELF = 2703;

    /**
     *
     */
    const AWATYPEDISABLED = 2800;

    /**
     *
     */
    const AWATOOMANYPENDINGREQUESTS = 2801;

    /**
     *
     */
    const AWATHEFEATUREREQUIRESAREGISTEREDDEVICE = 2802;

    /**
     *
     */
    const AWAREQUESTWASUNANSWEREDFORTOOLONG = 2803;

    /**
     *
     */
    const AWAWRITEREQUESTMISSINGORINVALIDTOKEN = 2804;

    /**
     *
     */
    const AWAWRITEREQUESTTOKENEXPIRED = 2805;

    /**
     *
     */
    const AWAWRITEREQUESTTOKENUSAGELIMITREACHED = 2806;

    /**
     *
     */
    const CLANFIRETEAMNOTFOUND = 3000;

    /**
     *
     */
    const CLANFIRETEAMADDNOALTERNATESFORIMMEDIATE = 3001;

    /**
     *
     */
    const CLANFIRETEAMFULL = 3002;

    /**
     *
     */
    const CLANFIRETEAMALTFULL = 3003;

    /**
     *
     */
    const CLANFIRETEAMBLOCKED = 3004;

    /**
     *
     */
    const CLANFIRETEAMPLAYERENTRYNOTFOUND = 3005;

    /**
     *
     */
    const CLANFIRETEAMPERMISSIONS = 3006;

    /**
     *
     */
    const CLANFIRETEAMINVALIDPLATFORM = 3007;

    /**
     *
     */
    const CLANFIRETEAMCANNOTADJUSTSLOTCOUNT = 3008;

    /**
     *
     */
    const CLANFIRETEAMINVALIDPLAYERPLATFORM = 3009;

    /**
     *
     */
    const CLANFIRETEAMNOTREADYFORINVITESNOTENOUGHPLAYERS = 3010;

    /**
     *
     */
    const CLANFIRETEAMGAMEINVITESNOTSUPPORTFORPLATFORM = 3011;

    /**
     *
     */
    const CLANFIRETEAMPLATFORMINVITEPREQFAILURE = 3012;

    /**
     *
     */
    const CLANFIRETEAMINVALIDAUTHCONTEXT = 3013;

    /**
     *
     */
    const CLANFIRETEAMINVALIDAUTHPROVIDERPSN = 3014;

    /**
     *
     */
    const CLANFIRETEAMPS4SESSIONFULL = 3015;

    /**
     *
     */
    const CLANFIRETEAMINVALIDAUTHTOKEN = 3016;

    /**
     *
     */
    const CLANFIRETEAMSCHEDULEDFIRETEAMSDISABLED = 3017;

    /**
     *
     */
    const CLANFIRETEAMNOTREADYFORINVITESNOTSCHEDULEDYET = 3018;

    /**
     *
     */
    const CLANFIRETEAMNOTREADYFORINVITESCLOSED = 3019;

    /**
     *
     */
    const CLANFIRETEAMSCHEDULEDFIRETEAMSREQUIREADMINPERMISSIONS = 3020;

    /**
     *
     */
    const CLANFIRETEAMNONPUBLICMUSTHAVECLAN = 3021;

    /**
     *
     */
    const CLANFIRETEAMPUBLICCREATIONRESTRICTION = 3022;

    /**
     *
     */
    const CLANFIRETEAMALREADYJOINED = 3023;

    /**
     *
     */
    const CLANFIRETEAMSCHEDULEDFIRETEAMSRANGE = 3024;

    /**
     *
     */
    const CLANFIRETEAMPUBLICCREATIONRESTRICTIONEXTENDED = 3025;

    /**
     * Returns the string version of the enum value
     *
     * @param int $type
     * @return string
     *
     * @todo Populate this function
     */
    public static function getLabel($type)
    {
        // TODO: Implement getLabel() method.
        return $type;
    }
}