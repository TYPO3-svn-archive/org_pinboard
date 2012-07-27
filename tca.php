<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


/**
 * Configuration by the extension manager
 */
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['org']);


/**
 * TCA tx_org_pinboardcat
 */
$TCA['tx_org_pinboardcat'] = array(
	'ctrl' => $TCA['tx_org_pinboardcat']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,title'
	),
	'feInterface' => $TCA['tx_org_pinboardcat']['feInterface'],
	'columns' => array(
		'sys_language_uid' => $TCA['tt_content']['columns']['sys_language_uid'],
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array(
						'',
						0,
					),
				),
				'foreign_table'       => 'tx_org_pinboardcat',
				'foreign_table_where' => 'AND tx_org_pinboardcat.pid=###CURRENT_PID### '
											. 'AND tx_org_pinboardcat.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough'
			),
		),
		'hidden'    => $TCA['tt_content']['columns']['hidden'],
		'starttime' => $TCA['tt_content']['columns']['starttime'],
		'endtime'   => $TCA['tt_content']['columns']['endtime'],
		'fe_group'  => $TCA['tt_content']['columns']['fe_group'],
		'title'     => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboardcat.title',
			'config'  => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim,required',
			),
		),
	),
	'types' => array(
		'0' => array(
			'showitem' => '
					sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource,
					title;;;;1-1-1,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended',
		),
	),
	'palettes' => array(
		'access' => $TCA['tt_content']['palettes']['access'],
	),
);



/**
 * TCA tx_org_pinboard
 */
$TCA['tx_org_pinboard'] = array(
	'ctrl' => $TCA['tx_org_pinboard']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,datetime,'
									. 'archivedate,author,fe_user,title,subtitle,bodytext,image,imagecaption,tx_org_pinboardcat',
	),
	'feInterface' => $TCA['tx_org_pinboard']['feInterface'],
	'columns' => array(
		'sys_language_uid' => $TCA['tt_content']['columns']['sys_language_uid'],
		'l10n_parent' => array(		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array(
						'',
						0,
					),
				),
				'foreign_table'       => 'tx_org_pinboard',
				'foreign_table_where' => 'AND tx_org_pinboard.pid=###CURRENT_PID### '
											. 'AND tx_org_pinboard.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(		
			'config' => array(
				'type' => 'passthrough'
			),
		),
		'hidden'      => $TCA['tt_content']['columns']['hidden'],
		'fe_group'    => $TCA['tt_content']['columns']['fe_group'],
		'datetime'    => $TCA['tx_org_news']['columns']['datetime'],
		'archivedate' => $TCA['tx_org_news']['columns']['archivedate'],
		'author'      => $TCA['pages']['columns']['author'],
		'fe_user'     => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_core.xml:labels.feUser',
			'config' => array(
				'type'          => 'group',
				'internal_type' => 'db',
				'allowed'       => 'fe_users',
				'size'          => 1,
				'minitems'      => 0,
				'maxitems'      => 1,
				'MM'            => 'tx_org_pinboard_fe_user_mm',
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					),
				),
			),
		),
		'title' => array(		
			'exclude' => 0,		
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.title',
			'config' => array(
				'type' => 'input',	
				'size' => '50',
				'eval' => 'trim,required',
			),
		),
		'subtitle'              => $TCA['pages']['columns']['subtitle'],
		'bodytext'              => $TCA['tt_content']['columns']['bodytext'],
		'image'                 => $TCA['tt_content']['columns']['image'],
		'image'                 => $TCA['tt_content']['columns']['image'],
		'imagewidth'            => $TCA['tt_content']['columns']['imagewidth'],
		'imageheight'           => $TCA['tt_content']['columns']['imageheight'],
		'imageorient'           => $TCA['tt_content']['columns']['imageorient'],
		'imagecaption'          => $TCA['tt_content']['columns']['imagecaption'],
		'imagecols'             => $TCA['tt_content']['columns']['imagecols'],
		'imageborder'           => $TCA['tt_content']['columns']['imageborder'],
		'imagecaption_position' => $TCA['tt_content']['columns']['imagecaption_position'],
		'image_link'            => $TCA['tt_content']['columns']['image_link'],
		'image_zoom'            => $TCA['tt_content']['columns']['image_zoom'],
		'image_noRows'          => $TCA['tt_content']['columns']['image_noRows'],
		'image_effects'         => $TCA['tt_content']['columns']['image_effects'],
		'image_compression'     => $TCA['tt_content']['columns']['image_compression'],
		'image_frames'          => $TCA['tt_content']['columns']['image_frames'],
		'altText'               => $TCA['tt_content']['columns']['altText'],
		'titleText'             => $TCA['tt_content']['columns']['titleText'],
		'media'                 => $TCA['tt_content']['columns']['media'],
		'mediacaption'          => $TCA['tt_content']['columns']['imagecaption'],
		'tx_org_pinboardcat' => array(
			'exclude' => 0,		
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.category',
			'config' => array(
				'type' => 'select',	
				'foreign_table' => 'tx_org_pinboardcat',
				'foreign_table_where' => 'AND tx_org_pinboardcat.pid=###CURRENT_PID### ORDER BY tx_org_pinboardcat.uid',
				'size' => 10,	
				'minitems' => 0,
				'maxitems' => 99,	
				'MM' => 'tx_org_pinboard_tx_org_pinboardcat_mm',
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_org_pinboardcat',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_org_pinboardcat',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
	),
	'types' => array(
		'0' => array(
			'showitem' => '
					sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource,
					--palette--;LLL:EXT:org_pinboard/locallang_db.xml:tx_org_pinboard.title;header,
					--palette--;LLL:EXT:lang/locallang_general.xml:LGL.author;author,
					bodytext;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_orgpinboard/rte/],
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.images,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagefiles;imagefiles,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagelinks;imagelinks,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_accessibility;image_accessibility,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_settings;image_settings,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imageblock;imageblock,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.textlayout;textlayout,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.media,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:multimedia_formlabel;media,
				--div--;LLL:EXT:lang/locallang_common.xml:category,
					tx_org_pinboardcat,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended',
		),
	),
	'palettes' => array(
		'header' => array(
			'showitem'       => '
					title, --linebreak--,
					subtitle, --linebreak--,
					datetime, archivedate',
			'canNotCollapse' => 1,
		),
		'author' => array(
			'showitem'       => '
					author, --linebreak--,
					fe_user',
			'canNotCollapse' => 1,
		),
		'imagefiles'          => $TCA['tt_content']['palettes']['imagefiles'],
		'imagelinks'          => $TCA['tt_content']['palettes']['imagelinks'],
		'image_accessibility' => $TCA['tt_content']['palettes']['image_accessibility'],
		'frames'              => $TCA['tt_content']['palettes']['frames'],
		'image_settings'      => $TCA['tt_content']['palettes']['image_settings'],
		'imageblock'          => $TCA['tt_content']['palettes']['imageblock'],
		'textlayout'          => $TCA['tt_content']['palettes']['textlayout'],
		'media'  => array(
			'showitem'       => '
					media, mediacaption;LLL:EXT:cms/locallang_ttc.xml:imagecaption_formlabel',
			'canNotCollapse' => 1,
		),
		'access' => $TCA['tt_content']['palettes']['access'],
		'visibility' => array(
			'showitem'       => '
					hidden;;',
			'canNotCollapse' => 1,
		),
	),
);

	//  field property adjustment
$TCA['tx_org_pinboard']['columns']['datetime']['config']['size']    = 13;
$TCA['tx_org_pinboard']['columns']['datetime']['config']['eval']   .= ',required';
$TCA['tx_org_pinboard']['columns']['archivedate']['config']['size'] = 13;
$TCA['tx_org_pinboard']['columns']['archivedate']['config']['eval'] = 'datetime';
$TCA['tx_org_pinboard']['columns']['author']['label']               = 'LLL:EXT:lang/locallang_general.xml:LGL.name';
$TCA['tx_org_pinboard']['columns']['author']['config']['size']      = 50;

	// Simplify the Organiser
$bool_exclude_none    = true;
$bool_exclude_default = true;
switch ($confArr['TCA_simplify_organiser']) {
	case('None excluded: Editor has access to all'):
		$bool_exclude_none    = false;
		$bool_exclude_default = false;
		break;
	case('Default (recommended)'):
		$bool_exclude_default = false;
		break;
	case('All excluded: Administrator configures it'):
	default:
		// All will be left true.
		break;
}
$TCA['tx_org_pinboard']['columns']['hidden']['exclude']    = $bool_exclude_default;
?>