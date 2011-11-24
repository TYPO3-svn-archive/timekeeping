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
class Tx_Timekeeping_Domain_Model_Timeunit extends Tx_Extbase_DomainObject_AbstractEntity {

	/*
	 * ATTRIBUTES
	 */


	/**
	 * assignment
	 *
	 * @var Tx_Timekeeping_Domain_Model_Assignment
	 */
	protected $assignment;

	/**
	 * Date when the work was done
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $dateOfWork;

	/**
	 * How much time was needed
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $duration;

	/**
	 * What work was done
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Cleaning Work?
	 *
	 * @var boolean
	 */
	protected $cleaning;

	
	/**
	 * GETTERS
	 */

	/**
	 * Returns the assignment
	 *
	 * @return Tx_Timekeeping_Domain_Model_Assignment The assignment
	 */
	public function getAssignment() {
		return $this->assignment;
	}

	/**
	 *
	 * Gets the family
	 * @return Tx_Timekeeping_Domain_Model_Family The family
	 *
	 */

	public function getFamily() {
		return $this->getAssignment()->getFamily();
	}

	/**
	 *
	 * Gets the user
	 * @return Tx_Timekeeping_Domain_Model_User The user
	 *
	 */

	public function getUser() {
		return $this->getAssignment()->getUser();
	}

	/**
	 * Returns the dateOfWork
	 *
	 * @return DateTime $dateOfWork
	 */
	public function getDateOfWork() {
		if($this->dateOfWork == NULL) {
			return $this->dateOfWork;
		} else {
			return $this->dateOfWork->format('d.m.Y');
		}
	}

	/**
	 * Returns the duration
	 *
	 * @return float $duration
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 *
	 * Gets the worked time
	 * @return float The worked time in hours
	 *
	 */

	public function getWorkedTime() {
		return floatval($this->duration);
	}

	/**
	 *
	 * Gets the worked cleaning time
	 * @return float The worked cleaning time in hours
	 *
	 */

	public function getWorkedCleaningTime() {
		if($this->isCleaning()) {
			return floatval($this->duration);
		}
	}

	/**
	 *
	 * Gets the worked time in hours.
	 * @return double The worked time in hours
	 *
	 */

	public function getWorkedTimeInHours() {
		return $this->getWorkedTime() / 3600;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Returns the cleaning
	 *
	 * @return boolean $cleaning
	 */
	public function getCleaning() {
		return $this->cleaning == 1;
	}

	/**
	 * Returns the boolean state of cleaning
	 *
	 * @return boolean
	 */
	public function isCleaning() {
		return $this->getCleaning();
	}




	/**
	 * SETTERS
	 */
	

	/**
	 * Sets the assignment
	 *
	 * @param Tx_Timekeeping_Domain_Model_Assignment $assignment The assignment
	 * @return void
	 */
	public function setAssignment(Tx_Timekeeping_Domain_Model_Assignment $assignment) {
		$this->assignment = $assignment;
	}

	/**
	 * Sets the dateOfWork
	 *
	 * @param DateTime $dateOfWork
	 * @return void
	 */
	public function setDateOfWork($dateOfWork) {
		$this->dateOfWork = $dateOfWork;
	}

	/**
	 * Sets the duration
	 *
	 * @param float $duration
	 * @return void
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Sets the cleaning
	 *
	 * @param boolean $cleaning
	 * @return void
	 */
	public function setCleaning($cleaning) {
		$this->cleaning = $cleaning;
	}

}
?>