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

class Tx_Timekeeping_Domain_Validator_TimeunitValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {



	/**
	 *
	 * Determines if a timeunit object is valid.
	 * @param Tx_Timekeeping_Domain_Model_Timeunit $timeunit The timeunit object that
	 *                                                           is to be validated.
	 * @return boolean TRUE, if the timeunit object is valid, otherwise FALSE.
	 *
	 */
	
	public function isValid($timeunit) {

		if(!$timeunit instanceof Tx_Timekeeping_Domain_Model_Timeunit)
			$this->addError(Tx_Extbase_Utility_Localization::translate('Timeunit_Error_Invalid', 'Timekeeping'), 1265721022);
		//if($timeunit->getStarttime() >= $timeunit->getStoptime())
		//	$this->addError(Tx_Extbase_Utility_Localization::translate('Timeunit_Error_1265721025', 'Timekeeping'), 1265721025);

		return count($this->getErrors()) === 0;

	}

}

?>
