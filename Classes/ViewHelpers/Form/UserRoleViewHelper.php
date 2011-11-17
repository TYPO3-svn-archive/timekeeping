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

class Tx_Timekeeping_ViewHelpers_Form_UserRoleViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper {



		/**
		 *
		 * Initializes the ViewHelper arguments.
		 * @return void
		 *
		 */

	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument ( 'family', 'Tx_Timekeeping_Domain_Model_Family', '', TRUE );
		$this->registerArgument ( 'user'   , 'Tx_Timekeeping_Domain_Model_User'     , '', TRUE );
	}



		/**
		 *
		 * Gets the selectable options for this select field. This methods overrides the
		 * respective method in the Tx_Fluid_ViewHelpers_Form_SelectViewHelper class.
		 * @return array The selectable options for this select field.
		 *
		 */

	protected function getOptions() {
		$options = array(0 => 'Kein Mitglied');
		foreach($this->arguments['options'] As $option) {
			if($option instanceof Tx_Timekeeping_Domain_Model_Role)
				$options[$option->getUid()] = $option->getName();
		} return $options;
	}



		/**
		 *
		 * Determines the selected value of this select field. This method determines if
		 * the user (specified by the "user" argument) is a member of the current family
		 * (specified by the "family" argument) in a specific role.
		 * This method overrides the respective method of the
		 * Tx_Fluid_ViewHelpers_Form_SelectViewHelper class.
		 *
		 * @return int The Uid of the user role, the current user is assigned in, or 0 if
		 *             the user is not a member of the family.
		 *
		 */

	protected function getSelectedValue() {
		$assignment = $this->arguments['family'] ? $this->arguments['family']->getAssignmentForUser($this->arguments['user']) : NULL;
		return $assignment ? $assignment->getRole()->getUid() : 0;
	}



		/**
		 *
		 * Gets the name of the form field. This method overrides the respective method
		 * of the Tx_Fluid_ViewHelpers_Form_SelectViewHelper class.
		 *
		 * @return string The form field name
		 *
		 */

	protected function getName() {
		return parent::getName().'['.$this->arguments['user']->getUid().']';
	}

}

?>
