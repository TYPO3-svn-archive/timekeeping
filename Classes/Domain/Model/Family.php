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
class Tx_Timekeeping_Domain_Model_Family extends Tx_Extbase_DomainObject_AbstractEntity {

	/*
	 * ATTRIBUTES
	 */


	/**
	 * Name of the Family
	 *
	 * @var string
	 * @validate StringLength(minimum = 3, maximum = 255) || EmailAddress
	 */
	protected $name;
	

	/**
	 * The parent family. For toplevel families, this attribute is NULL
	 * @var Tx_Timekeeping_Domain_Model_Family
	 */
	protected $family = NULL;

	/**
	 * When do the family join the school
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $start;

	/**
	 * When do the family leave the school
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $end;

	/**
	 * The date this family was last edited on.
	 * @var DateTime
	 */
	protected $tstamp;

	/**
	 * Assignments to this family
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Assignment>
	 * @lazy
	 * @cascade delete
	 */
	protected $assignments;

	/**
	 * The sub-family of this family.
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Family>
	 * @lazy
	 * @cascade remove
	 */
	protected $children;

	/**
	 * A caching array for the members of this family. This array maps the user role
	 * Uid to all users assigned in this role.
	 * @var array<array<Tx_Extbase_Domain_Model_FrontendUser>>
	 */
	protected $members = NULL;

	/**
	 * A list of all timeunits that are assigned to this family-
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Extbase_Domain_Model_Timeunit>
	 */
	protected $timeunits = NULL;

	/**
	 * Number of working hours to be done
	 *
	 * @var Tx_Timekeeping_Domain_Model_RequiredHours
	 */
	protected $requiredHours;

	

	/*
	 * CONSTRUCTORS
	 */


	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
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
		$this->assignments = new Tx_Extbase_Persistence_ObjectStorage();
	}


	/*
	 * GETTERS
	 */


	/**
	 * Returns the name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * Gets the parent family.
	 * @return Tx_Timekeeping_Domain_Model_Family The parent family
	 *
	 */

	public function getParent() {
		return $this->family;
	}



	/**
	 *
	 * Gets the parent family.
	 * @return Tx_Timekeeping_Domain_Model_Family The parent family
	 *
	 */

	public function getFamily() {
		return $this->family;
	}


	/**
	 * Returns the start
	 *
	 * @return DateTime $start
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * Returns the end
	 *
	 * @return DateTime $end
	 */
	public function getEnd() {
		return $this->end;
	}

	/**
	 *
	 * Gets the edit date.
	 * @return DateTime The edit date
	 *
	 */

	public function getEditDate() {
		return $this->tstamp;
	}


	/**
	 * Returns the assignments
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Assignment>
	 */
	public function getAssignments() {
		return $this->assignments;
	}


	/**
	 *
	 * Gets the worked time as sum of all timeunit.
	 * @return int The worked time
	 *
	 */

	public function getWorkedTime() {
		$time = 0.0;
		foreach ($this->getTimeunits() as $timeunit) {
			$time += $timeunit->getWorkedTime();
		}
		return $time;
	}


	/**
	 *
	 * Gets the worked time as sum of all timeunit.
	 * @return int The worked time
	 *
	 */

	public function getWorkedCleaningTime() {
		$time = 0.0;
		foreach ($this->getTimeunits() as $timeunit) {
			$time += $timeunit->getWorkedCleaningTime();
		}
		return $time;
	}


	/**
	 *
	 * Gets a list of all timeunits that were created for this family. The timeunit
	 * list is ordered by the family member.
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Timekeeping_Domain_Model_Timeunit>
	 *
	 */

	public function getTimeunits() {
		if($this->timeunits === NULL) {
			$this->timeunits = New Tx_Extbase_Persistence_ObjectStorage();
			foreach($this->getAssignments() as $assignment) {
				$this->timeunits->addAll($assignment->getTimeunits());
			}
		}
		return $this->timeunits;
	}

	/**
	 *
	 * Gets all users that are assigned to this family in a specific user role
	 * @param Tx_Timekeeping_Domain_Model_Role $role The role for which the users are to be selected
	 * @return array<Tx_Extbase_Domain_Model_FrontendUser> The users assigned to this family in the specified role
	 *
	 */

	public function getUsersForRole(Tx_Timekeeping_Domain_Model_Role $role) {
		if($this->members[$role->getUid()] == NULL) {
			$this->members[$role->getUid()] = Array();
			foreach($this->getAssignments() as $assignment)
				if($assignment->getRole()->getUid() == $role->getUid())
					array_push($this->members[$role->getUid()], $assignment->getUser());
		}
		return $this->members[$role->getUid()];
	}

	/**
	 *
	 * Gets the family for a user
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user The role for which the users are to be selected
	 * @return array<Tx_Extbase_Domain_Model_FrontendUser> The users assigned to this family in the specified role
	 *
	 */

	public function getFamilyForUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		foreach ($this->assignments as $assignment) {
			if ($assignment->getUser()->getUID() === $user->getUID()) return $assignment->getFamily();
		}
		return NULL;
	}

	/**
	 *
	 * Gets the family assignment for a specific user.
	 * @param  Tx_Extbase_Domain_Model_FrontendUser		 $user The user for which the assignment
	 *															is to be retrieved
	 * @return Tx_Timekeeping_Domain_Model_Assignment	   The family assignment for the specified
	 *															user, or NULL if the user is not a member
	 *															of this family
	 *
	 */

	public function getAssignmentForUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		foreach ($this->assignments as $assignment) {
			if ($assignment->getUser()->getUID() === $user->getUID()) return $assignment;
		}
		return NULL;
	}

	/**
	 *
	 * Determines whether a specific user is assigned to this family
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user The user whose assignment is
	 *												   to be checked.
	 * @return boolean								   TRUE, if the user is assigned
	 *												   to this family, otherwise
	 *												   FALSE.
	 *
	 */

	public function getIsAssigned(Tx_Extbase_Domain_Model_FrontendUser $user) {
		return $this->getAssignmentForUser($user) !== NULL;
	}


	/**
	 *
	 * Gets all sub family for this family.
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Extbase_Domain_Model_Family>
	 *
	 */

	public function getChildren() {
		return $this->children;
	}


	/**
	 * Returns the requiredHours
	 *
	 * @return Tx_Timekeeping_Domain_Model_RequiredHours $requiredHours
	 */
	public function getRequiredHours() {
		return $this->requiredHours;
	}



	/*
	 * SETTERS
	 */


	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return string name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 *
	 * Sets the parent family
	 * @param Tx_Timekeeping_Domain_Model_Family $parent The parent family
	 * @return void
	 *
	 */

	public function setFamily(Tx_Timekeeping_Domain_Model_Family $parent=NULL) {
		$this->parent = $parent;
	}

	/**
	 * Sets the start
	 *
	 * @param DateTime $start
	 * @return void
	 */
	public function setStart($start) {
		$this->start = $start;
	}

	/**
	 * Sets the end
	 *
	 * @param DateTime $end
	 * @return void
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

	/**
	 * Sets the requiredHours
	 *
	 * @param Tx_Timekeeping_Domain_Model_RequiredHours $requiredHours
	 * @return void
	 */
	public function setRequiredHours(Tx_Timekeeping_Domain_Model_RequiredHours $requiredHours) {
		$this->requiredHours = $requiredHours;
	}



	/**
	 *
	 * Clears all user assignments.
	 * @return void
	 *
	 */

	public function removeAllAssignments() {
		$this->assignments = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 *
	 * Assigns a user to this family using a specified user role.
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser   $user The user that is to be assigned
	 *													 to this family.
	 * @param Tx_Timekeeping_Domain_Model_Role $role The role the user is to be
	 *													 assigned in.
	 * @return void
	 *
	 */

	public function assignUser( Tx_Extbase_Domain_Model_FrontendUser   $user,
								Tx_Timekeeping_Domain_Model_Role $role) {
		if (!$this->getIsAssigned($user)) {
			$assignment = new Tx_Timekeeping_Domain_Model_Assignment($user, $this, $role);
			$this->assignments->attach($assignment);
		}
	}

	/**
	 *
	 * Unassigns a specific user.
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user The user that is to be unassigned
	 * @return void
	 *
	 */

	public function unassignUser( Tx_Extbase_Domain_Model_FrontendUser $user) {
		foreach($this->getAssignments() as $assignment) {
			if($assignment->getUser()->getUID() === $user->getUID()) $this->assignments->detach($assignment);
		}
	}

	/**
	 *
	 * Adds a new subfamily.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The new subfamily
	 * @return void
	 *
	 */

	public function addChild(Tx_Timekeeping_Domain_Model_Family $family) {
		$family->setParent($this);
		$this->children->attach($family);
	}


	/**
	 * Adds a Assignment
	 *
	 * @param Tx_Timekeeping_Domain_Model_Assignment $assignment
	 * @return void
	 */
	public function addAssignment(Tx_Timekeeping_Domain_Model_Assignment $assignment) {
		$this->assignments->attach($assignment);
	}

}

?>