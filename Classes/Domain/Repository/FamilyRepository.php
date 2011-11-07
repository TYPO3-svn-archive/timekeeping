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

class Tx_Timekeeping_Domain_Repository_FamilyRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 *
	 * Finds all families for an index view. The parent family can be specified
	 * using the $family parameter (NULL by default). All families are ordered by the
	 * family name in ascending order.
	 *
	 * @param  Tx_Timekeeping_Domain_Model_Family $family The parent family
	 * @return Array<Tx_Timekeeping_Domain_Model_Family>  The result list.
	 *
	 */

	public function findForIndexView ( Tx_Timekeeping_Domain_Model_Family $parent = NULL ) {

		$query = $this->createQuery();
		return $query
			->matching($query->equals('family', $parent ? $parent : Array(0,NULL) ))
			->setOrderings(array('name' => Tx_Extbase_Persistence_Query::ORDER_ASCENDING))
			->execute();

	}

	/**
	 *
	 * Finds the family for an given user. The parent family can be specified
	 * using the $family parameter (NULL by default). All families are ordered by the
	 * family name in ascending order.
	 *
	 * @param  Tx_Extbase_Domain_Model_FrontendUser $user The user
	 * @return Array<Tx_Timekeeping_Domain_Model_Family>  The result list.
	 *
	 */

	public function findFamilyForUser ( Tx_Extbase_Domain_Model_FrontendUser $user = NULL ) {

		$query = $this->createQuery();
		return $query
			->matching($query->equals('user', $user ? $user : Array(0,NULL) ))
			->setOrderings(array('name' => Tx_Extbase_Persistence_Query::ORDER_ASCENDING))
			->execute();

	}
}
?>