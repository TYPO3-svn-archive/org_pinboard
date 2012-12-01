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
	 * Hook for email change
	 * This hook allows to change the emails (subject, receiver, sender, etc..)
	 *
	 * Used for filling field `approval_id`
	 *
	 * @param   string   $subpart:             recipient_mail || sender_mail
	 * @param   array    $maildata:            mail header data (receiver, subject etc.)
	 * @param   array    $sessiondata:         value array of current powermail field values
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   object   $pObj:                parent object
	 * @return  void
	 * @access  public
	 */
	public function PM_SubmitEmailHook(&$subpart, &$maildata, &$sessiondata, &$markerArray, &$pObj) {
			//  hook activated?
		if (empty ($pObj->conf['ext.'][$this->extKey . '.']['hooks.']['PM_SubmitEmailHook'])) {
			return;
		}

		$lConf =& $pObj->conf['ext.'][$this->extKey . '.']['hooks.']['PM_SubmitEmailHook.'];
			//  execute sub function
		if (!empty ($lConf['function'])) {
			$functions = t3lib_div::trimExplode(',', $lConf['function']);
			foreach ($functions as $function) {
				if (method_exists($this, $function)) {
					$this->$function($lConf[$function . '.'], $subpart, $maildata, $sessiondata, $markerArray, $pObj);
				}
			}
		}
	}

	/**
	 * Calculate random hash identifier and add to session
	 *
	 * @param   string   $lConf:               function relevant part of TypoScript config
	 * @param   string   $subpart:             recipient_mail || sender_mail
	 * @param   array    $maildata:            mail header data (receiver, subject etc.)
	 * @param   array    $sessiondata:         value array of current powermail field values
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   object   $pObj:                parent object
	 * @return  void
	 * @access  private
	 */
	private function fillApprovalId(&$lConf, &$subpart, &$maildata, &$sessiondata, &$markerArray, &$pObj) {
			//  only if subpart recipient_mail
		if ($subpart == 'recipient_mail') {
				//  sys_registry: get last approval id suffix
			$registry             = t3lib_div::makeInstance('t3lib_Registry');
			$lastApprovalIdSuffix = $registry->get($this->prefixId, 'approvalIdSuffix');
			$lastApprovalIdSuffix = (int)$lastApprovalIdSuffix;

				//  calculate random hash as identifier
			$approvalId = $lastApprovalIdSuffix . md5($this->extKey . (microtime(TRUE) * 10000));
			$sessiondata[$lConf['fill']] = $approvalId;

				//  sys_registry: increase last approval id suffix
			$registry->set($this->prefixId, 'approvalIdSuffix', ($lastApprovalIdSuffix + 1));


				// replace marker for approving:
			if (!empty ($lConf['approve_pid'])) {
				$linkApprove = $pObj->cObj->typolink(
					$lConf['approve_approve'],
					array(
						'parameter'        => (int)$lConf['approve_pid'],
						'additionalParams' => '&tx_orgpinboard_pi1[approval]=0&tx_orgpinboard_pi1[approval_id]=' . $sessiondata['approval_id'],
						'forceAbsoluteUrl' => 1,
					)
				);
				$linkReject = $pObj->cObj->typolink(
					$lConf['approve_reject'],
					array(
						'parameter'        => (int)$lConf['approve_pid'],
						'additionalParams' => '&tx_orgpinboard_pi1[approval]=-1&tx_orgpinboard_pi1[approval_id]=' . $sessiondata['approval_id'],
						'forceAbsoluteUrl' => 1,
					)
				);
## @ToDo: remove debugging
if ($_SERVER['REMOTE_ADDR'] == '141.54.175.176') {
##	echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>'; exit;
##	echo '<pre><b>$pObj->mailcontent @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($pObj->mailcontent, 1) . '</pre>';
##	echo '<pre><b>$linkApprove @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($linkApprove, 1) . '</pre>';
##	echo '<pre><b>$linkReject @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($linkReject, 1) . '</pre>';
}
				$search  = array(
					'***ORG_PINNBOARD_APPROVE***',
					'***ORG_PINNBOARD_REJECT***',
				);
				$replace = array(
					$linkApprove,
					$linkReject,
				);
				$pObj->mailcontent['recipient_mail'] = str_replace($search, $replace, $pObj->mailcontent['recipient_mail']);
## @ToDo: remove debugging
if ($_SERVER['REMOTE_ADDR'] == '141.54.175.176') {
##	echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>'; exit;
##	echo '<pre><b>$pObj->mailcontent @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($pObj->mailcontent, 1) . '</pre>'; exit;
}
			}
		}
	}

	/**
	 * Clean password field
	 *
	 * @param   string   $lConf:               function relevant part of TypoScript config
	 * @param   string   $subpart:             recipient_mail || sender_mail
	 * @param   array    $maildata:            mail header data (receiver, subject etc.)
	 * @param   array    $sessiondata:         value array of current powermail field values
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   object   $pObj:                parent object
	 * @return  void
	 * @access  private
	 */
	private function cleanPassword(&$lConf, &$subpart, &$maildata, &$sessiondata, &$markerArray, &$pObj) {
		$keyField   = 'uid' . $lConf['field'];
		$keyValue   = $lConf['value'];
		$cleanField = 'uid' . $lConf['clean'];
		if ($sessiondata[$keyField] == $keyValue) {
			$sessiondata[$cleanField] = '';
		}
	}


	// -------------------------------------------------------------------------
	/**
	 * Submit hook after emails
	 * If you want to do something after a correct submit, you can use this hook (maybe an additional db entry)
	 *
	 * Used for storing entry in db
	 *
	 * @param   object   $pObj:                parent object
	 * @param   array    $markerArray:         marker array of current powermail field
	 * @param   array    $sessiondata:         value array of current powermail field values
	 * @return  void
	 * @access public
	 */
	public function PM_SubmitAfterMarkerHook(&$pObj, &$markerArray, &$sessiondata) {
			//  hook activated?
		if (empty ($pObj->conf['ext.'][$this->extKey . '.']['hooks.']['PM_SubmitAfterMarkerHook'])) {
			return;
	}

		$lConf =& $pObj->conf['ext.'][$this->extKey . '.']['hooks.']['PM_SubmitAfterMarkerHook.'];
			//  execute sub function
		if (!empty ($lConf['function'])) {
			$functions = t3lib_div::trimExplode(',', $lConf['function']);
			foreach ($functions as $function) {
				if (method_exists($this, $function)) {
					$this->$function($lConf, $pObj, $markerArray, $sessiondata);
				}
			}
		}
##echo '<pre><b>$sessiondata @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($sessiondata, 1) . '</pre>';
##exit;
	}


	/**
	 * Entry to `tx_org_pinboard`
	 *
	 * @return  void
	 * @access  private
	 */
	private function dbEntryOrgpinboard(&$lConf, &$pObj, &$markerArray, &$sessiondata) {
		$table         = (!empty ($lConf['table'])) ? $lConf['table'] : 'tx_org_pinboard';
		$fields_values = array(
			'tstamp' => time(),
			'crdate' => time(),
		);
			//  fields with predefined value
		if (!empty ($lConf['fields.']['fixValue.']) AND is_array($lConf['fields.']['fixValue.'])) {
			foreach ($lConf['fields.']['fixValue.'] as $fKey => $fVal) {
				$fields_values[$fKey] = $fVal;
			}
		}
			//  fields with value from user input: fieldname = fielduid
		if (!empty ($lConf['fields.']['userValue.']) AND is_array($lConf['fields.']['userValue.'])) {
			foreach ($lConf['fields.']['userValue.'] as $uKey => $uVal) {
				$fields_values[$uKey] = $sessiondata['uid' . $uVal];
			}
		}
			//  fields with special computing: fieldname = true/false
		if (!empty ($lConf['fields.']['special.']) AND is_array($lConf['fields.']['special.'])) {
			foreach ($lConf['fields.']['special.'] as $sKey => $sVal) {
					//  skip sub arrays
				if (preg_match('/\.$/', $sKey)) {
					continue;
				}
					//  skip disabled fields
				if (empty ($sVal)) {
					continue;
				}
				$fConf                =& $lConf['fields.']['special.'][$sKey . '.'];
				$fFunction            = '_' . $fConf['function'];
				$fields_values[$sKey] = $this->$fFunction($fConf, $sessiondata, $fields_values);
			}
		}

## @ToDo: remove debugging
if ($_SERVER['REMOTE_ADDR'] == '141.54.158.70') {
##echo '<pre><b>$fields_values @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($fields_values, 1) . '</pre>';
##echo '<pre><b>$markerArray @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($markerArray, 1) . '</pre>';
##echo '<pre><b>$sessiondata @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($sessiondata, 1) . '</pre>';
$sql = $GLOBALS['TYPO3_DB']->INSERTquery($table, $fields_values, $no_quote_fields = FALSE);
echo '<pre><b>$sql @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($sql, 1) . '</pre>';
#exit;
}
		$GLOBALS['TYPO3_DB']->exec_INSERTquery($table, $fields_values, $no_quote_fields = FALSE);
		$insertId = $GLOBALS['TYPO3_DB']->sql_insert_id();
			//  store new uid in session
		$extSessionData = array(
			'insertId' => $insertId,
		);
		$GLOBALS['TSFE']->fe_user->setKey('ses', $this->extKey, $extSessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();


			//  mm
		if (!empty ($lConf['mm.']) AND is_array($lConf['mm.'])) {
			foreach ($lConf['mm.'] as $mmVal) {
				$entries = array_flip($mmVal['entries.']);
				$table         = $mmVal['mmTable'];
				$fields_values = array(
					'uid_local'   => $insertId,
					'uid_foreign' => $entries[$sessiondata['uid' . $mmVal['field']]],
					'sorting'     => 1,
				);
if ($_SERVER['REMOTE_ADDR'] == '141.54.158.70') {
$sql = $GLOBALS['TYPO3_DB']->INSERTquery($table, $fields_values, $no_quote_fields = FALSE);
echo '<pre><b>$sql @ ' . __FILE__ . '::' . __LINE__ . ':</b> ' . print_r($sql, 1) . '</pre>';
exit;
}
				$GLOBALS['TYPO3_DB']->exec_INSERTquery($table, $fields_values, $no_quote_fields = FALSE);
			}
		}
##exit;

			//  clear cache of configured pages
		if (!empty ($lConf['clearPageCacheContent_pidList'])) {
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($lConf['clearPageCacheContent_pidList']);
		}
		}


	private function _setHiddenIfGuest(&$fConf, &$sessiondata) {
		$hidden = ($sessiondata['uid' . $fConf['field']] == $fConf['value']) ? 1 : 0;
		return $hidden;
	}

	private function _combineDateTime(&$fConf, &$sessiondata) {
		@list($day, $month, $year) = t3lib_div::trimExplode('.', $sessiondata['uid' . $fConf['field']]);
		@list($hour, $minute)      = t3lib_div::trimExplode(':', $sessiondata['uid' . $fConf['value']]);
		$datetime = mktime($hour, $minute, 0, $month, $day, $year);
		return $datetime;
	}

	private function _addToDatetime(&$fConf, &$sessiondata, &$fields_values) {
		$values = array_flip($fConf['value.']);
		$value  = $values[$sessiondata['uid' . $fConf['field']]] * 3600;
		$archivedate = $value + $fields_values[$fConf['value']];
		return $archivedate;
	}

	private function _checkboxValue(&$fConf, &$sessiondata) {
		$value = (!empty ($sessiondata['uid' . $fConf['field']][0])) ? 1 : 0;
		return $value;
	}

	private function _setApprovalId(&$fConf, &$sessiondata) {
		$value = $sessiondata[$fConf['value']];
		return $value;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/lib/class.tx_orgpinboard_hooks_powermail_pi1.php']);
}
?>