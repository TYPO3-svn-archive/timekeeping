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


class Tx_Timekeeping_Controller_FamilyController extends Tx_Timekeeping_Controller_AbstractController {


	/*
	 * ATTRIBUTES
	 */



	/**
	 * familyRepository
	 *
	 * @var Tx_Timekeeping_Domain_Repository_FamilyRepository
	 */
	protected $familyRepository;

	public function injectFamilyRepository(Tx_Timekeeping_Domain_Repository_FamilyRepository $familyRepository){
					$this->familyRepository = $familyRepository;
	}
	/**
	 * A user role repository instance
	 * @var Tx_Timekeeping_Domain_Repository_RoleRepository
	 */
	protected $roleRepository;

	public function injectRoleRepository(Tx_Timekeeping_Domain_Repository_RoleRepository $roleRepository){
					$this->roleRepository = $roleRepository;
	}
	/**
	 * A frontend user repository instance
	 * @var Tx_Timekeeping_Domain_Repository_UserRepository
	 */
	protected $userRepository;

	public function injectUserRepository(Tx_Timekeeping_Domain_Repository_UserRepository $userRepository){
					$this->userRepository = $userRepository;
	}

	/**
	 * A timeunit repository instance
	 * @var Tx_Timekeeping_Domain_Repository_TimeunitRepository
	 */
	protected $timeunitRepository;

	public function injectTimeunitRepository(Tx_Timekeeping_Domain_Repository_TimeunitRepository $timeunitRepository){
					$this->timeunitRepository = $timeunitRepository;
	}

	/**
	 * A assignment repository instance
	 * @var Tx_Timekeeping_Domain_Repository_AssignmentRepository
	 */
	protected $assignmentRepository;

	public function injectAssignmentRepository(Tx_Timekeeping_Domain_Repository_AssignmentRepository $assignmentRepository){
					$this->assignmentRepository = $assignmentRepository;
	}

	/*
	 * ACTION METHODS
	 */

	
	/**
	 *
	 * The initialization action. This methods creates instances of all required
	 * repositories.
	 *
	 * @return void
	 *
	 */

	protected function initializeAction() {
	}

	/**
	 *
	 * The index action. Displays a list of all families.
	 * @return void
	 *
	 */

	public function indexAction() {
		$this->view->assign('families', $this->familyRepository->findForIndexView());
	}


	/**
	 * action show
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family that is to be displayed.
	 * @return void
	 */
	public function showAction(Tx_Timekeeping_Domain_Model_Family $family) {
		$assignmentsToRemove = $this->assignmentRepository->findByFamily();
		foreach($assignmentsToRemove as $assignmentToRemove) {
			$this->assignmentRepository->remove($assignmentToRemove);
			//$this->flashMessages->add("Die Beziehung {$assignmentToRemove->getUid()} wurde gelöscht.");
		}
		$this->view->assign('family', $family);
	}

	/**
	 *
	 * The new action. Displays a form for creating a new project.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The new family
	 * @return void
	 * @dontvalidate $family
	 *
	 */

	public function newAction(Tx_Timekeeping_Domain_Model_Family $family = NULL) {
		$this->view->assign('family' , $family)
				   ->assign('families', array_merge(Array(NULL), $this->familyRepository->findAll()))
				   ->assign('users'   , $this->userRepository->sortByCol(array('username' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING)))
				   ->assign('roles'   , $this->roleRepository->findAll());
	}

	/**
	 *
	 * The create action. This method creates a new project and stores it into the
	 * database.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The new family
	 * @param array $assignments                                 An array of users and roles that are to be assigned to this family.
	 * @return void
	 * @dontverifyrequesthash
	 *
	 */

	public function createAction( Tx_Timekeeping_Domain_Model_Family $family, $assignments ) {
		$family->removeAllAssignments();
		foreach($assignments as $userId => $roleId) {
			if($roleId == 0) continue;
			$family->assignUser ( $this->userRepository->findByUid((int)$userId),
								   $this->roleRepository->findByUid((int)$roleId) );
		}
		$this->familyRepository->add($family);
		$this->flashMessages->add('Die Familie ' . $family->getName() . ' wurde erfolgreich angelegt.');

		$this->redirect('index');
	}

	/**
	 * action edit
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family
	 * @return void
	 * @dontvalidate $family
	 */
	public function editAction(Tx_Timekeeping_Domain_Model_Family $family) {
		$this->view->assign('family' , $family)
		           ->assign('families', array_merge(Array(NULL), $this->familyRepository->findAll()))
		           ->assign('users'   , $this->userRepository->findAll())
		           ->assign('roles'   , $this->roleRepository->findAll());
	}

	/**
	 *
	 * The update action. Updates an existing family in the database.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family    $family       The family
	 * @param array                                 $assignments  An array of users and roles that are to be assigned to this family.
	 * @return void
	 * @dontverifyrequesthash
	 *
	 */

	public function updateAction( Tx_Timekeeping_Domain_Model_Family $family, $assignments ) {
		$family->removeAllAssignments();

		foreach($assignments as $userId => $roleId) {
			if($roleId == 0) {
				//$family->unassignUser($this->userRepository->findByUid((int)$userId));
				continue;
			}
			$family->assignUser($this->userRepository->findByUid((int)$userId),
			                    $this->roleRepository->findByUid((int)$roleId)
							   );

			$timeunitsForUser = $this->timeunitRepository->getTimeunitsForUser($this->userRepository->findByUid((int)$userId));
			$assignmentsForUser = $family->getAssignmentForUser($this->userRepository->findByUid((int)$userId));
			foreach ($timeunitsForUser as $timeunitForUser) {
				$assignmentsForUser->addTimeunit($timeunitForUser);
			}
			
		}

		$this->familyRepository->update($family);
		$this->flashMessages->add("Die Familie {$family->getName()} wurde erfolgreich bearbeitet.");


		$this->redirect('show', NULL, NULL, array('family' => $family));
	}



	/**
	 *
	 * The delete action. Deletes an existing family from the database.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family The family that is to be deleted
	 * @return void
	 *
	 */

	public function deleteAction( Tx_Timekeeping_Domain_Model_Family $family ) {
		$this->familyRepository->remove($family);
		$this->flashMessages->add("Die Familie {$family->getName()} wurde erfolgreich gelöscht.");

		$this->redirect('index');
	}

}
?>