<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Alexander Grein <ag@mediaessenz.eu>, MEDIA::ESSENZ
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 *
 * @package timekeeping
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */


class Tx_Timekeeping_ViewHelpers_TimeFormatViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {



	/**
	 *
	 * Renders the time amount.
	 *
	 * @param  int    $amount The time amount in seconds
	 * @return string         The formatted output
	 * 
	 */

	public function render($amount) {
		$unit = 'Hours';

		/*
		if($amount == 0) {
			$unit = 'Hours';
		} elseif($amount >= 604800) {
			$unit = 'Days';
			$amount /= 86400.00;
		} elseif($amount >= 3600) {
			$unit = 'Hours';
			$amount /= 3600;
		} elseif($amount >= 60) {
			$unit = 'Minutes';
			$amount /= 60.00;
		}
		*/
		return number_format($amount, 2, ',', '') . ' ' . Tx_Extbase_Utility_Localization::translate('ViewHelper_Unit_' . $unit, 'Timekeeping');
	}

}

?>
