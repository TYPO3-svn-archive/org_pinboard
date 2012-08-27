<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


if (TYPO3_MODE != 'BE') {
	/**
	 * Hooks for powermail
	 */
	$_hookConf =& $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['powermail'];
	$_hookFile = 'EXT:org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php';
	$_hookCall = $_hookFile . ':tx_orgpinboard_hooks_powermail_pi1';

		//  Hook for markerArray in field generation (inner markerArray for checkboxes, radiobuttons, and so on)
		//  This hook will be used for every kind of field. You can manipulate the markerArray before the field is generated
		//  (this hook will be used for innerMarkerArray – checkbox, radiobuttons, etc...)
	$_hookConf['PM_FieldWrapMarkerArrayHookInner'][] = $_hookCall;
		//  Hook for manipulation of default markers
		//  Useful if you want to prefill some powermail fields with your own stuff, etc...:
	$_hookConf['PM_FieldWrapMarkerHook1'][]          = $_hookCall;

	$_hookConf['PM_MarkerArrayHook'][]               = $_hookCall;
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