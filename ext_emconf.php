<?php

########################################################################
# Extension Manager/Repository config file for ext "org_pinboard".
#
# Auto generated 14-08-2012 17:19
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
	'version' => '0.3.0',
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
	'_md5_values_when_last_written' => 'a:20:{s:9:"ChangeLog";s:4:"75bb";s:19:"de.locallang_db.xlf";s:4:"1835";s:21:"ext_conf_template.txt";s:4:"a349";s:12:"ext_icon.gif";s:4:"ec42";s:17:"ext_localconf.php";s:4:"f7d0";s:14:"ext_tables.php";s:4:"5ad2";s:14:"ext_tables.sql";s:4:"6cf4";s:16:"locallang_db.xlf";s:4:"5333";s:7:"tca.php";s:4:"9992";s:12:"doc/ToDo.txt";s:4:"741c";s:31:"doc/org_pinboard.fallstudie.sxw";s:4:"953e";s:48:"lib/class.tx_orgpinboard_hooks_powermail_pi1.php";s:4:"02d9";s:32:"res/ico/icon_tx_org_pinboard.gif";s:4:"4079";s:35:"res/ico/icon_tx_org_pinboardcat.gif";s:4:"4079";s:33:"res/tpl/pinboard/1601/default.css";s:4:"8652";s:39:"res/tpl/pinboard/1601/default.tmpl.html";s:4:"ba34";s:25:"static/base/constants.txt";s:4:"d41d";s:21:"static/base/setup.txt";s:4:"d41d";s:29:"static/pinboard/constants.txt";s:4:"d41d";s:25:"static/pinboard/setup.txt";s:4:"2ac6";}',
	'suggests' => array(
	),
);

?>