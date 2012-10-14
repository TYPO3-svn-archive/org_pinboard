<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_orgpinboard_pi1.php', '_pi1', 'list_type', 0);


if (TYPO3_MODE != 'BE') {
	/**
	 * Hooks for powermail
	 */
	$_hookConf =& $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail'];
	$_hookFile = 'EXT:org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php';
	$_hookCall = $_hookFile . ':tx_orgpinboard_hooks_powermail_pi1';

		//  Hook for email change
		//  This hook allows to change the emails (subject, receiver, sender, etc..)
		//  Used for filling field `approval_id`
	$_hookConf['PM_SubmitEmailHook'][]       = $_hookCall;

		//  Submit hook after emails
		//  If you want to do something after a correct submit, you can use this hook (maybe an additional db entry)
		//  used for storing entry in db
	$_hookConf['PM_SubmitAfterMarkerHook'][] = $_hookCall;
}



##########

t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_org_pinboardcat=1');
t3lib_extMgm::addUserTSConfig('options.saveDocNew.tx_org_pinboard=1');
t3lib_extMgm::addPageTSConfig('

	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_org_pinboard", field "bodytext"
	# ***************************************************************************************
RTE.config.tx_org_pinboard.bodytext {
  hidePStyleItems = H1, H4, H5, H6
  proc.exitHTMLparser_db=1
  proc.exitHTMLparser_db {
    keepNonMatchedTags=1
    tags.font.allowedAttribs= color
    tags.font.rmTagIfNoAttrib = 1
    tags.font.nesting = global
  }
}
');
?>