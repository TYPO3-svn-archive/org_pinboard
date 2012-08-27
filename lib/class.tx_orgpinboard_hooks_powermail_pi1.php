<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Ulfried Herrmann <herrmann@die-netzmacher.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *   48: class tx_orgkeq_hooks_kequestionnaire_pi1
 *   63:     public function pi1_noQuestions(&$pObj)
 *  113:     public function pi1_setResultsSaveFields(&$pObj, $saveFields)
 *  155:     public function pi1_getQuestions(&$pObj)
 *  208:     public function pi1_renderLastPage(&$pObj, $result_id, &$markerArray)
 *
 * TOTAL FUNCTIONS: 4
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * Hooks for use in tx_kequestionnaire_pi1
 *
 * @author	Ulfried Herrmann <herrmann@die-netzmacher.de>
 * @package	TYPO3
 * @subpackage	tx_orgkeq
 */
class tx_orgpinboard_hooks_powermail_pi1 {

	public $prefixId = 'tx_orgpinboard_hooks_powermail_pi1';    //  Same as class name
	public $extKey   = 'org_pinboard';                          //  The extension key.


	// -------------------------------------------------------------------------
	/**
	 * Constructor
	 *
	 * @return  void
	 * @access public
	 */
	public function __construct() {
	###	$this->conf =& $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_browser_pi1.']['extensions.']['tx_orgkeq.'];
	}



	// -------------------------------------------------------------------------
	/**
	 * Hook for manipulation of default markers
	 * Useful if you want to prefill some powermail fields with your own stuff, etc...
	 *
	 * Used to prefill `datetime` field
	 *
	 * @param   int      $uid:                 uid current powermail field
	 * @param   string   $xml:                 flexform config current powermail field
	 * @param   string   $type:                type of current powermail field
	 * @param   string   $title:               title of current powermail field
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   array    $piVarsFromSession:   piVars powermail
	 * @param   object   $pObj:                parent object
	 * @return  void
	 * @access public
	 */
	public function PM_markerArrayHook(&$what, &$geoArray, &$markerArray, &$sessiondata, &$tmpl, &$pObj) {
#echo '<pre><b>$what @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($what, 1) . '</pre>' . LF;
#echo '<pre><b>$geoArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($geoArray, 1) . '</pre>' . LF;
#echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>' . LF;
#echo '<pre><b>$sessiondata @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($sessiondata, 1) . '</pre>';
#echo '<pre><b>$tmpl @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($tmpl, 1) . '</pre>' . LF;
###echo '<pre><b>$pObj @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($pObj, 1) . '</pre>' . LF;
#exit;
	}



	// -------------------------------------------------------------------------
	/**
	 * Hook for manipulation of default markers
	 * Useful if you want to prefill some powermail fields with your own stuff, etc...
	 *
	 * Used to prefill `datetime` field
	 *
	 * @param   int      $uid:                 uid current powermail field
	 * @param   string   $xml:                 flexform config current powermail field
	 * @param   string   $type:                type of current powermail field
	 * @param   string   $title:               title of current powermail field
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   array    $piVarsFromSession:   piVars powermail
	 * @param   object   $pObj:                parent object
	 * @return  void
	 * @access public
	 */
	public function PM_FieldWrapMarkerHook1(&$uid, &$xml, &$type, &$title, &$markerArray, &$piVarsFromSession, &$pObj) {
		$pObj->piVars['uid5'] = time();
		if ($uid == 5) {
##echo '<pre><b>$uid @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($uid, 1) . '</pre>' . LF;
##echo '<pre><b>$xml @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($xml, 1) . '</pre>' . LF;
##echo '<pre><b>$type @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($type, 1) . '</pre>' . LF;
##echo '<pre><b>$title @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($title, 1) . '</pre>' . LF;
##echo '<pre><b>$piVarsFromSession @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($piVarsFromSession, 1) . '</pre>';
##echo '<pre><b>$pObj @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($pObj, 1) . '</pre>' . LF;
			$markerArray['###VALUE###'] = 'value="' . time() . '"';
##echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>' . LF;
##exit;
		}
	}



	// -------------------------------------------------------------------------
	/**
	 * Hook for markerArray in field generation (inner markerArray for checkboxes, radiobuttons, and so on)
	 * This hook will be used for every kind of field. You can manipulate the markerArray before the field is generated
	 * (this hook will be used for innerMarkerArray – checkbox, radiobuttons, etc...)
	 *
	 * Used to prefill `tx_org_pinboardcat` filed
	 */
	public function PM_FieldWrapMarkerHookInner(&$uid, &$xml, &$type, &$title, &$markerArray, &$piVarsFromSession, &$pObj) {
###echo# '<pre><b>$uid @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($uid, 1) . '</pre>';
####exit;
##if ($uid == 8) {
//localise: $GLOBALS['TSFE']->lang
##echo '<pre><b>$uid @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($uid, 1) . '</pre>' . LF;
##echo '<pre><b>$xml @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($xml, 1) . '</pre>' . LF;
##echo '<pre><b>$type @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($type, 1) . '</pre>' . LF;
##echo '<pre><b>$title @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($title, 1) . '</pre>' . LF;
##echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>' . LF;
##echo '<pre><b>$piVarsFromSession @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($piVarsFromSession, 1) . '</pre>';
##echo '<pre><b>$pObj @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($pObj, 1) . '</pre>' . LF;
##exit;
##}
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php']);
}
?>