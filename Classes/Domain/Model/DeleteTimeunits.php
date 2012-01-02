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
class Tx_Timekeeping_Domain_Model_DeleteTimeunits extends Tx_Extbase_DomainObject_AbstractEntity {

	/*
	 * ATTRIBUTES
	 */


	/**
	 * Date from which timeunits should be deleted
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $fromDate;

	/**
	 * Date to which timeunits should be deleted
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $toDate;



	/**
	 * GETTERS
	 */

	/**
	 * Returns the fromDate
	 *
	 * @return DateTime $fromDate
	 */
	public function getFromDate() {
		if($this->fromDate == NULL) {
			return $this->fromDate;
		} else {
			return $this->fromDate->format('U');
		}
	}

	/**
	 * Returns the toDate
	 *
	 * @return DateTime $toDate
	 */
	public function getToDate() {
		if($this->toDate == NULL) {
			return $this->toDate;
		} else {
			return $this->toDate->format('U');
		}
	}



	/**
	 * SETTERS
	 */


	/**
	 * Sets the fromDate
	 *
	 * @param DateTime $fromDate
	 * @return void
	 */
	public function setFromDate($fromDate) {
		$this->fromDate = $fromDate;
	}

	/**
	 * Sets the toDate
	 *
	 * @param DateTime $dateOfWork
	 * @return void
	 */
	public function setToDate($toDate) {
		$this->toDate = $toDate;
	}

}
?>