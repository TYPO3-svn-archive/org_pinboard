<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


/**
 * Configuration by the extension manager
 */
$orgConfArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['org']);

	// Language for labels of static templates and page tsConfig
$llStatic = ($orgConfArr['LLstatic'] == 'German') ? 'de' : 'default';


$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
$TCA['tx_org_pinboard'] = array(
	'ctrl' => array(
		'title'                    => 'LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboard',
		'label'                    => 'title',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'cruser_id'                => 'cruser_id',
	##	'languageField'            => 'sys_language_uid',
	##	'transOrigPointerField'    => 'l10n_parent',
	##	'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby'           => 'ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled'  => 'hidden',
		##	'starttime' => 'starttime',
		##	'endtime'   => 'endtime',
			'fe_group'  => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'dividers2tabs'     => 1,
		'requestUpdate'     => 'fe_user',
		'searchFields'      => 'author,fe_user,title,subtitle,bodytext,imagecaption,altText,titleText,mediaText',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif',
		'typeicon_column'   => 'approval',
		'typeicons'         => array(
			 1 => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard_grey.gif',
			 0 => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif',
			-1 => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard_grey.gif',
		),
	),
);
if (!empty ($extConf['TCA_datetime_in_enablecolumns'])) {
	$TCA['tx_org_pinboard']['ctrl']['enablecolumns']['starttime'] = 'datetime';
}

$TCA['tx_org_pinboardcat'] = array(
	'ctrl' => array(
		'title'         => 'LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboardcat',
		'label'         => 'title',
		'tstamp'        => 'tstamp',
		'crdate'        => 'crdate',
		'cruser_id'     => 'cruser_id',
		'sortby'        => 'sorting',
		'delete'        => 'deleted',
		'enablecolumns' => array(
			'disabled'  => 'hidden',
		),
		'hideAtCopy'        => false,
		'dividers2tabs'     => 1,
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'searchFields'      => 'title',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboardcat.gif',
	),
);


$label = ($llStatic == 'de') ? 'Org: Pinnwand' : 'Org: Pinboard';

##t3lib_extMgm::addStaticFile($_EXTKEY,'static/base/',     'base');
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/pinboard/', '+' . $label);


/**
 * Add pagetree icons
 */
$type  = 'org_pinnb';
$TCA['pages']['columns']['module']['config']['items'][] = array(
	$label,
	$type,
	t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif'
);
t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-' . $type,
		t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif');


/**
 * add plugin `pinboard entry approval`
 */
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1']='layout,select_key';

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:org_pinboard/locallang.xlf:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif',
), 'list_type');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_orgpinboard_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.tx_orgpinboard_pi1_wizicon.php';
}



/**
 * Add fields to org tables
 */

t3lib_div::loadTCA('tx_org_cal');
	//  tx_org_news: add `user_buw_organiser_allow_in_oj`, `user_buw_organiser_display_in_oj`
$tempColumns = array(
	'approval' => array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:' . $_EXTKEY . '/locallang_db.xlf:tx_org_pinboard.approval',
		'config'  => array(
			'type'    => 'radio',
				'items' => array(
					array('LLL:EXT:' . $_EXTKEY . '/locallang_db.xlf:tx_org_pinboard.approval.pending', 1),
					array('LLL:EXT:' . $_EXTKEY . '/locallang_db.xlf:tx_org_pinboard.approval.approved', 0),
					array('LLL:EXT:' . $_EXTKEY . '/locallang_db.xlf:tx_org_pinboard.approval.rejected', -1)
				),
			'default' => 0,
		),
	),
);
t3lib_extMgm::addTCAcolumns('tx_org_cal', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('tx_org_cal', 'approval', '', 'after:hidden');
?>