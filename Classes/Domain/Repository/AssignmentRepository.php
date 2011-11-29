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
class Tx_Timekeeping_Domain_Repository_AssignmentRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 *
	 * Finds all families for an index view. The parent family can be specified
	 * using the $family parameter (NULL by default). All families are ordered by the
	 * family name in ascending order.
	 *
	 * @param  Tx_Timekeeping_Domain_Model_Family $family The family
	 * @return Array<Tx_Timekeeping_Domain_Model_Assignment>  The result list.
	 *
	 */

	public function findByFamily ( Tx_Timekeeping_Domain_Model_Family $family = NULL ) {

		$query = $this->createQuery();
		return $query
			->matching($query->equals('family', $family ? $family : Array(0,NULL) ))
			->execute();

	}

}
?>