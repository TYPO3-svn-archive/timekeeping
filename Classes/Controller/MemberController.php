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


class Tx_Timekeeping_Controller_MemberController extends Tx_Timekeeping_Controller_AbstractController {


	/*
	 * ATTRIBUTES
	 */


	/**
	 * A family repository instance
	 * @var Tx_Timekeeping_Domain_Repository_FamilyRepository
	 */
	protected $familyRepository;

	/**
	 * A frontend user repository instance
	 * @var Tx_Extbase_Domain_Repository_FrontendUserRepository
	 */
	protected $userRepository;


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
		$this->familyRepository  =& t3lib_div::makeInstance('Tx_Timekeeping_Domain_Repository_FamilyRepository');
		$this->userRepository    =& t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository');
	}

	/**
	 *
	 * The index action. This method displays a list of all timeunits for the current user
	 * @return void
	 *
	 */
	public function indexAction () {
		$timeunitRepository =& t3lib_div::makeInstance('Tx_Timekeeping_Domain_Repository_TimeunitRepository');
		$user = $this->getCurrentFeUser();
		// how do i get the family of the current user?
		$family = 1;
		if($user === NULL) throw new Tx_Timekeeping_Domain_Exception_NoLoginException();
		$this->view->assign('timeunits', $timeunitRepository->getTimeunitsForUser($user))
				   ->assign('user', $user)
				   ->assign('family', $family);
	}

	/**
	 * action show
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user The user that is to be displayed.
	 * @return void
	 */
	public function showAction(Tx_Extbase_Domain_Model_FrontendUser $user) {
		$this->view->assign('user', $user);
	}

	/*
	 * HELPER METHODS
	 */


	/**
	 *
	 * Gets the currently logged in frontend user.
	 * @return Tx_Extbase_Domain_Model_FrontendUser The currently logged in frontend
	 *                                              user, or NULL if no user is
	 *                                              logged in.
	 *
	 */

	protected function getCurrentFeUser() {
		$userRepository = new Tx_Extbase_Domain_Repository_FrontendUserRepository();
		return intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0
			? $userRepository->findByUid( intval($GLOBALS['TSFE']->fe_user->user['uid']) )
			: NULL;
	}



}
?>