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
class Tx_Timekeeping_Controller_TimeunitController extends Tx_Timekeeping_Controller_AbstractController {

	/*
	 * ATTRIBUTES
	 */


	/**
	 * A family repository instance
	 * @var Tx_Timekeeping_Domain_Repository_FamilyRepository
	 */
	protected $familyRepository;

	public function injectFamilyRepository(Tx_Timekeeping_Domain_Repository_FamilyRepository $familyRepository){
					$this->familyRepository = $familyRepository;
	}


	/**
	 * timeunitRepository
	 *
	 * @var Tx_Timekeeping_Domain_Repository_TimeunitRepository
	 */
	protected $timeunitRepository;

	public function injectTimeunitRepository(Tx_Timekeeping_Domain_Repository_TimeunitRepository $timeunitRepository){
					$this->timeunitRepository = $timeunitRepository;
	}

	/**
	 * A frontend user repository instance
	 * @var Tx_Timekeeping_Domain_Repository_UserRepository $userRepository
	 */
	protected $userRepository;

	public function injectUserRepository(Tx_Timekeeping_Domain_Repository_UserRepository $userRepository){
					$this->userRepository = $userRepository;
	}


	/**
	 *
	 * The initialization action. Creates instances of all required repositories.
	 * @return void
	 *
	 */

	public function initializeAction() {

	}



	/**
	 *
	 * The index action. This method displays a list of all timeunits for a specific
	 * family.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family for which the timeunits are to be
	 *                                                           displayed for.
	 * @return void
	 *
	 */
	public function indexAction ( Tx_Timekeeping_Domain_Model_Family $family ) {
		$this->view->assign('family' , $family)
				   ->assign('timeunits', $this->timeunitRepository->getTimeunitsForFamily($family));
	}


	/**
	 *
	 * The new action. This method displays a form for creating a new timeunit.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family the new timeunit is to be assigned to
	 * @param Tx_Timekeeping_Domain_Model_Timeunit $timeunit The new timeunit
	 * @return void
	 * @dontvalidate $timeunit
	 *
	 */
	
	public function newAction(Tx_Timekeeping_Domain_Model_Family $family,
								Tx_Timekeeping_Domain_Model_Timeunit $timeunit = NULL) {
		$user = $this->getCurrentFeUser();
		$assignment = $user ? $family->getAssignmentForUser($user) : NULL;
		if($assignment === NULL) throw new Tx_Timekeeping_Domain_Exception_NoFamilyMemberException();
		if ($timeunit == NULL) { // workaround for fluid bug ##5636
			$timeunit = t3lib_div::makeInstance('Tx_Timekeeping_Domain_Model_Timeunit');
		}
		$this->view->assign('family'   , $family     )
		           ->assign('timeunit'  , $timeunit   )
		           ->assign('user'      , $user       )
		           ->assign('assignment', $assignment );

	}

	/**
	 *
	 * The create action. Stores a new timeunit into the database.
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family the new timeunit is to be assigned to
	 * @param Tx_Timekeeping_Domain_Model_Timeunit $timeunit The new timeunit
	 * @return void
	 *
	 */

	public function createAction ( Tx_Timekeeping_Domain_Model_Family $family,
								   Tx_Timekeeping_Domain_Model_Timeunit $timeunit ) {

			# Get the user assignment and throw an exception if the current user is not a
			# member of the selected family.
		$user       = $this->getCurrentFeUser();
		$assignment = $user ? $family->getAssignmentForUser($user) : NULL;
		if($assignment === NULL) throw new Tx_Timekeeping_Domain_Exception_NoFamilyMemberException();

			# Add the new timeunit to the family assingment. The $assignment property in
			# the timeunit object is set automatically.
		$assignment->addTimeunit($timeunit);
		$timeunit->getFamily()->addAssignment($assignment);

			# Since the family is the aggregate root, update only the family to save
			# the new timeunit.
		$this->familyRepository->update($timeunit->getFamily());

			# Print a success message and return to the family detail view.
		$this->flashMessages->add('Zeitbuchung erfolgt.');
		$this->redirect('show', 'Family', NULL, array('family' => $timeunit->getFamily() ));
	}


	/*
	 * HELPER METHODS
	 */


	/**
	 *
	 * Gets the currently logged in frontend user.
	 * @return Tx_Timekeeping_Domain_Model_User The currently logged in frontend
	 *                                              user, or NULL if no user is
	 *                                              logged in.
	 *
	 */

	protected function getCurrentFeUser() {
		return intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0
			? $this->userRepository->findByUid( intval($GLOBALS['TSFE']->fe_user->user['uid']) )
			: NULL;
	}


}
?>