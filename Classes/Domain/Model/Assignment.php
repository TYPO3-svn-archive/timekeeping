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
class Tx_Timekeeping_Domain_Model_Assignment extends Tx_Extbase_DomainObject_AbstractEntity {

	/*
	 * ATTRIBUTES
	 */


	/**
	 * fe_user
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 * @lazy
	 */
	protected $user;

	/**
	 * family
	 *
	 * @var Tx_Timekeeping_Domain_Model_Family
	 * @lazy
	 */
	protected $family;

	/**
	 * role
	 *
	 * @var Tx_Timekeeping_Domain_Model_Role
	 * @lazy
	 */
	protected $role;

	/**
	 * timeunits
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Timeunit>
	 * @lazy
	 * @cascade remove
	 */
	protected $timeunits;



	/*
	 * CONSTRUCTOR
	 */


	/**
	 *
	 * Creates a new assignment. All arguments are optional, since every model class
	 * has to implement an empty constructor.
	 * 
	 * @param Tx_Extbase_Domain_Model_FrontendUser      $user    The user
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family
	 * @param Tx_Timekeeping__Domain_Model_Role    $role    The user role
	 *
	 * @return void
	 */
	public function __construct(Tx_Extbase_Domain_Model_FrontendUser	$user    = NULL,
	                              Tx_Timekeeping_Domain_Model_Family 	$family  = NULL,
	                              Tx_Timekeeping_Domain_Model_Role		$role    = NULL) {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
		if($user)    $this->setUser($user);
		if($family) $this->setFamily($family);
		if($role)    $this->role = $role;
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->timeunits = new Tx_Extbase_Persistence_ObjectStorage();
	}


	/**
	 * GETTERS
	 */

	
	/**
	 * Returns the associated user
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	public function getUser(){
		return $this->user;
	}

	/**
	 * Returns the family
	 *
	 * @return Tx_Timekeeping_Domain_Model_Family family
	 */
	public function getFamily() {
		If($this->family InstanceOf Tx_Extbase_Persistence_LazyLoadingProxy)
			$this->family->_loadRealInstance();

		return $this->family;
	}

	/**
	 * Returns the timeunits
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Timeunit> All timeunits
	 */
	public function getTimeunits() {
		return $this->timeunits;
	}

	/**
	 * Returns the role
	 *
	 * @return Tx_Timekeeping_Domain_Model_Role $role
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 *
	 * Gets the worked time as sum of all timeunits.
	 * @return int The worked time
	 *
	 */

	public function getWorkedTime() {
		$time = 0;
		foreach($this->getTimeunits() as $timeunit) {
			$time += $timeunit->getWorkedTime();
		}
		return $time;
	}

	/**
	 *
	 * Gets the worked cleaning time as sum of all timeunits.
	 * @return int The worked cleaning time
	 *
	 */

	public function getWorkedCleaningTime() {
		$time = 0;
		foreach($this->getTimeunits() as $timeunit) {
			$time += $timeunit->getWorkedCleaningTime();
		}
		return $time;
	}

	
	/**
	 * SETTERS
	 */


	/**
	 * Sets the associated user
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user The associated user
	 * @return void
	 */
	public function setUser(Tx_Extbase_Domain_Model_FrontendUser $user){
		$this->user = $user;
	}

	/**
	 * Sets the family
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family
	 * @return void
	 */
	public function setFamily(Tx_Timekeeping_Domain_Model_Family $family) {
		$this->family = $family;
	}

	/**
	 * Sets the role
	 *
	 * @param Tx_Timekeeping_Domain_Model_Role $role
	 * @return void
	 */
	public function setRole(Tx_Timekeeping_Domain_Model_Role $role) {
		$this->role = $role;
	}


	/**
	 * Adds a Timeunit
	 *
	 * @param Tx_Timekeeping_Domain_Model_Timeunit $timeunit
	 * @return void
	 */
	public function addTimeunit(Tx_Timekeeping_Domain_Model_Timeunit $timeunit) {
		$timeunit->setAssignment($this);
		$this->timeunits->attach($timeunit);
	}



}
?>