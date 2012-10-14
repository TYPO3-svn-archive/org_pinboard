#
# Table structure for table 'tx_org_pinboardcat'
#
CREATE TABLE tx_org_pinboardcat (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,
	title_lang_ol tinytext NOT NULL,
	image text,
	imagecaption text,
	altText text,
	titleText text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);




#
# Table structure for table 'tx_org_pinboard_fe_user_mm'
#
#
CREATE TABLE tx_org_pinboard_fe_user_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);




#
# Table structure for table 'tx_org_pinboard_tx_org_pinboardcat_mm'
#
#
CREATE TABLE tx_org_pinboard_tx_org_pinboardcat_mm (
  uid_local int(11) DEFAULT '0' NOT NULL,
  uid_foreign int(11) DEFAULT '0' NOT NULL,
  tablenames varchar(30) DEFAULT '' NOT NULL,
  sorting int(11) DEFAULT '0' NOT NULL,
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);



#
# Table structure for table 'tx_org_pinboard'
#
CREATE TABLE tx_org_pinboard (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	fe_group int(11) DEFAULT '0' NOT NULL,
	datetime int(11) DEFAULT '0' NOT NULL,
	archivedate int(11) DEFAULT '0' NOT NULL,
	author tinytext,
	fe_user int(11) DEFAULT '0' NOT NULL,
	title tinytext,
	subtitle tinytext,
	bodytext text,
	image text,
	imagewidth mediumint(11) unsigned DEFAULT '0' NOT NULL,
	imageheight mediumint(8) unsigned DEFAULT '0' NOT NULL,
	imageorient tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecaption text,
	imagecols tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imageborder tinyint(4) unsigned DEFAULT '0' NOT NULL,
	imagecaption_position varchar(6) DEFAULT '' NOT NULL,
	image_link text,
	image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,
	image_noRows tinyint(3) unsigned DEFAULT '0' NOT NULL,
	image_effects tinyint(3) unsigned DEFAULT '0' NOT NULL,
	image_compression tinyint(3) unsigned DEFAULT '0' NOT NULL,
	image_frames tinyint(3) unsigned DEFAULT '0' NOT NULL,
	altText text,
	titleText text,
	media text,
	mediacaption text,
	tx_org_pinboardcat int(11) DEFAULT '0' NOT NULL,
	approval tinyint(3) DEFAULT '0' NOT NULL,
	approval_id tinytext,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY approval_id (approval_id(45))
);