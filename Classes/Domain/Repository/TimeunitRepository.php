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
class Tx_Timekeeping_Domain_Repository_TimeunitRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 *
	 * Returns a container with all timeunits for a specific family, ordered by their
	 * date of work. This method does NOT use Extbase's Query Object Model, but rather
	 * a hardcoded SQL query. Althrough we lose DMBS portability by doing so, this is
	 * a good example on how to use this method.
	 *
	 * @param Tx_Timekeeping_Domain_Model_Family $family
	 * @return Array<Tx_Timekeeping_Domain_Model_Timeunit>
	 *
	 */

	public function getTimeunitsForFamily(Tx_Timekeeping_Domain_Model_Family $family) {

		$extbaseFrameworkConfiguration = Tx_Extbase_Dispatcher::getExtbaseFrameworkConfiguration();
		$pidList = implode(', ', t3lib_div::intExplode(',', $extbaseFrameworkConfiguration['persistence']['storagePid']));

		$sql = "SELECT t.*
				FROM        tx_timekeeping_domain_model_timeunit  t
					   JOIN tx_timekeeping_domain_model_assignment a ON t.assignment = a.uid
					   JOIN tx_timekeeping_domain_model_family    p ON a.family = p.uid
				WHERE      p.uid={$family->getUid()}
					   AND p.deleted=0 AND p.pid IN ($pidList)
					   AND a.deleted=0 AND a.pid IN ($pidList)
					   AND t.deleted=0 AND t.pid IN ($pidList)
				ORDER BY t.date_of_work DESC";

		$query = $this->createQuery();
		$query->statement($sql);
		return $query->execute();

	}

	/**
	 *
	 * Returns a container with all timeunits for a specific user, ordered by their
	 * date of work. This method does NOT use Extbase's Query Object Model, but rather
	 * a hardcoded SQL query. Althrough we lose DMBS portability by doing so, this is
	 * a good example on how to use this method.
	 *
	 * @param Tx_Timekeeping_Domain_Model_User $user
	 * @return Array<Tx_Timekeeping_Domain_Model_Timeunit>
	 *
	 */

	public function getTimeunitsForUser(Tx_Timekeeping_Domain_Model_User $user) {

		$extbaseFrameworkConfiguration = Tx_Extbase_Dispatcher::getExtbaseFrameworkConfiguration();
		$pidList = implode(', ', t3lib_div::intExplode(',', $extbaseFrameworkConfiguration['persistence']['storagePid']));

		$sql = "SELECT t.*
				FROM        tx_timekeeping_domain_model_timeunit  t
					   JOIN tx_timekeeping_domain_model_assignment a ON t.assignment = a.uid
					   JOIN tx_timekeeping_domain_model_family    p ON a.family = p.uid
				WHERE      a.user={$user->getUID()}
					   AND p.deleted=0 AND p.pid IN ($pidList)
					   AND a.deleted=0 AND a.pid IN ($pidList)
					   AND t.deleted=0 AND t.pid IN ($pidList)
				ORDER BY t.date_of_work DESC";

		$query = $this->createQuery();
		$query->statement($sql);
		return $query->execute();

	}
}
?>