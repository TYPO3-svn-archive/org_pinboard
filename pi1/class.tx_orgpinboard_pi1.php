<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Ulfried Herrmann <herrmann.at.die-netzmacher.de>
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
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'org_pinboard approval' for the 'org_pinboard' extension.
 *
 * @author	Ulfried Herrmann <herrmann.at.die-netzmacher.de>
 * @package	TYPO3
 * @subpackage	tx_jquploader
 */
class tx_orgpinboard_pi1 extends tslib_pibase {
	public    $prefixId      = 'tx_orgpinboard_pi1';                // Same as class name
	public    $scriptRelPath = 'pi1/class.tx_orgpinboard_pi1.php';  // Path to this script relative to the extension dir.
	public    $extKey        = 'org_pinboard';                      // The extension key.

	/**
	 * Main method of your PlugIn
	 *
	 * @param	string		$content: The content of the PlugIn
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	The content that should be displayed on the website
	 */
	public function main($content, $conf) {
			//  prepare plugin config
		$this->conf = $conf;
		$this->pi_loadLL();


			//  check piVar approval
		$error = $this->checkPiVars();
		if (!empty ($error)) {
			return $this->pi_wrapInBaseClass($error);
		}


			//  update record
		$content .= $this->approval();

		return $this->pi_wrapInBaseClass($content);
	}


	/**
	 * check piVars
	 *
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	void
	 */
	protected function checkPiVars() {
		$error = '';
			//  check piVar approval_id
		if (!isset ($this->piVars['approval'])) {
			$error .= '<p class="error">' . $this->pi_getLL('error.piVarApprovalEmpty') . '</p>';
		}
		if (!t3lib_div::inList('-1,0', $this->piVars['approval'])) {
			$error .= '<p class="error">' . $this->pi_getLL('error.piVarApprovalInvalid') . '</p>';
		}
			//  display messages if any from previous step
		if (empty ($this->piVars['approval_id'])) {
			$error .= '<p class="error">' . $this->pi_getLL('error.piVarApprovalIdEmpty') . '</p>';
		}

		return $error;
	}


	/**
	 * approve record
	 *
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	void
	 */
	protected function approval() {
		$table         = (!empty ($this->conf['table'])) ? $this->conf['table'] : 'tx_org_pinboard';
		$where         = 'approval_id = ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->piVars['approval_id']);
		$fields_values = array(
			'approval' => (int)$this->piVars['approval'],
		);
		$GLOBALS['TYPO3_DB']->exec_UPDATEquery($table, $where, $fields_values);

		$num = $GLOBALS['TYPO3_DB']->sql_affected_rows();
		if ($num != 1) {
			$content = '<p class="error">' . $this->pi_getLL('error.approval') . '</p>';
		} else {
			switch ($this->piVars['approval']) {
			case -1:
				$key = 'success.approval.reject';
				break;
			case 0:
				$key = 'success.approval.approve';
				break;
			}
			$content = '<p class="success">' . $this->pi_getLL($key) . '</p>';

				//  clear cache
			$this->clearCache();
		}

		return $content;
	}


	/**
	 * clear cache
	 *
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	void
	 */
	protected function clearCache() {
			//  pages configured
		if (!empty ($this->cObj->data['pages'])) {
				//  get pidList
			$pidList = $this->pi_getPidList($this->cObj->data['pages'], $this->cObj->data['recursive']);
				//  clear cache
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($pidList);
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/pi1/class.tx_orgpinboard_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/org_pinboard/pi1/class.tx_orgpinboard_pi1.php']);
}
?>