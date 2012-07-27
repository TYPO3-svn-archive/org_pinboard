<?php

########################################################################
# Extension Manager/Repository config file for ext "org_pinboard".
#
# Auto generated 23-06-2012 17:08
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Organiser +Pinboard',
	'description' => 'Extend your Organiser with a pinboard. 
Organiser +Pinboard includes database, TypoScript and HTML templates.',
	'category' => 'plugin',
	'author' => 'Ulfried Herrmann (Die Netzmacher)',
	'author_email' => 'http://herrmann.at.die-netzmacher.de',
	'shy' => '',
	'dependencies' => 'cms,org',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_orgpinboard/rte/',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.1',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'org' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:45:{s:9:"ChangeLog";s:4:"49fc";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"c711";s:14:"ext_tables.php";s:4:"312e";s:14:"ext_tables.sql";s:4:"401b";s:34:"icon_tx_orgpinboard_categories.gif";s:4:"475a";s:29:"icon_tx_orgpinboard_items.gif";s:4:"355b";s:16:"locallang_db.xml";s:4:"c25e";s:7:"tca.php";s:4:"29af";s:31:"doc/org_pinboard.fallstudie.sxw";s:4:"bb29";s:19:"doc/wizard_form.dat";s:4:"a8d6";s:20:"doc/wizard_form.html";s:4:"21e4";s:34:"doc/captures/2012-06-23_141724.png";s:4:"5325";s:34:"doc/captures/2012-06-23_141808.png";s:4:"eb0b";s:34:"doc/captures/2012-06-23_141819.png";s:4:"c570";s:34:"doc/captures/2012-06-23_142318.png";s:4:"caa4";s:34:"doc/captures/2012-06-23_142605.png";s:4:"2bef";s:34:"doc/captures/2012-06-23_142848.png";s:4:"4e7c";s:34:"doc/captures/2012-06-23_143024.png";s:4:"58ad";s:34:"doc/captures/2012-06-23_143107.png";s:4:"a89d";s:34:"doc/captures/2012-06-23_143657.png";s:4:"bd04";s:34:"doc/captures/2012-06-23_143757.png";s:4:"7f55";s:34:"doc/captures/2012-06-23_143812.png";s:4:"7a5b";s:34:"doc/captures/2012-06-23_143838.png";s:4:"5ae5";s:34:"doc/captures/2012-06-23_144404.png";s:4:"6340";s:34:"doc/captures/2012-06-23_145021.png";s:4:"3b93";s:34:"doc/captures/2012-06-23_145426.png";s:4:"17d7";s:34:"doc/captures/2012-06-23_145613.png";s:4:"9f12";s:34:"doc/captures/2012-06-23_145744.png";s:4:"7d5e";s:34:"doc/captures/2012-06-23_151132.png";s:4:"0808";s:34:"doc/captures/2012-06-23_151144.png";s:4:"f26a";s:34:"doc/captures/2012-06-23_153852.png";s:4:"178a";s:34:"doc/captures/2012-06-23_154125.png";s:4:"0caa";s:34:"doc/captures/2012-06-23_154255.png";s:4:"15cc";s:34:"doc/captures/2012-06-23_165349.png";s:4:"c23e";s:34:"doc/captures/2012-06-23_165410.png";s:4:"2b98";s:34:"doc/captures/2012-06-23_165427.png";s:4:"6e7c";s:34:"doc/captures/2012-06-23_170509.png";s:4:"2fac";s:34:"doc/captures/2012-06-23_170529.png";s:4:"10d9";s:34:"doc/captures/2012-06-23_170701.png";s:4:"566c";s:25:"static/base/constants.txt";s:4:"d41d";s:21:"static/base/setup.txt";s:4:"d41d";s:29:"static/pinboard/constants.txt";s:4:"d41d";s:25:"static/pinboard/setup.txt";s:4:"d41d";}',
);

	//  use XLIFF in case of TYPO3 < 4.6.x
if (!t3lib_div::compat_version('4.6.0')) {
	$EM_CONF[$_EXTKEY]['dependencies'] .= ',xliff';
	$EM_CONF[$_EXTKEY]['constraints']['depends']['xliff'] = '';
}
?>