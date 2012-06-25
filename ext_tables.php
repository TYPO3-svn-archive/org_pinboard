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


$TCA['tx_org_pinboard'] = array(
	'ctrl' => array(
		'title'                    => 'LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboard',
		'label'                    => 'title',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'cruser_id'                => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby'           => 'ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled'  => 'hidden',
			'starttime' => 'starttime',
			'endtime'   => 'endtime',
			'fe_group'  => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'dividers2tabs'     => 1,
		'requestUpdate'     => 'fe_user',
		'searchFields'      => 'author,fe_user,title,subtitle,bodytext,imagecaption,altText,titleText,mediaText',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif',
	),
);

$TCA['tx_org_pinboardcat'] = array(
	'ctrl' => array(
		'title'                    => 'LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboardcat',
		'label'                    => 'title',
		'tstamp'                   => 'tstamp',
		'crdate'                   => 'crdate',
		'cruser_id'                => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'sortby'                   => 'sorting',
		'delete'                   => 'deleted',
		'enablecolumns' => array(
			'disabled'  => 'hidden',
			'starttime' => 'starttime',
			'endtime'   => 'endtime',
			'fe_group'  => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'dividers2tabs'     => 1,
		'requestUpdate'     => 'sys_language_uid',
		'searchFields'      => 'title',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboardcat.gif',
	),
);


t3lib_extMgm::addStaticFile($_EXTKEY,'static/base/',     'base');
t3lib_extMgm::addStaticFile($_EXTKEY,'static/pinboard/', 'pinboard');


/**
 * Add pagetree icons
 */
$label = ($llStatic == 'de') ? 'Org: Pinnwand' : 'Org: Pinboard';
$type  = 'org_pinnb';
$TCA['pages']['columns']['module']['config']['items'][] = array(
	$label,
	$type,
	t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif'
);
t3lib_SpriteManager::addTcaTypeIcon('pages', 'contains-' . $type,
		t3lib_extMgm::extRelPath($_EXTKEY) . 'res/ico/icon_tx_org_pinboard.gif');
?>