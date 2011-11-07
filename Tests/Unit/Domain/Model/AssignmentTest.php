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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Timekeeping_Domain_Model_Assignment.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Timekeeping
 *
 * @author Alexander Grein <ag@mediaessenz.eu>
 */
class Tx_Timekeeping_Domain_Model_AssignmentTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Timekeeping_Domain_Model_Assignment
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Timekeeping_Domain_Model_Assignment();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getFamilyReturnsInitialValueForTx_Timekeeping_Domain_Model_Family() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getFamily()
		);
	}

	/**
	 * @test
	 */
	public function setFamilyForTx_Timekeeping_Domain_Model_FamilySetsFamily() { 
		$dummyObject = new Tx_Timekeeping_Domain_Model_Family();
		$this->fixture->setFamily($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getFamily()
		);
	}
	
	/**
	 * @test
	 */
	public function getRoleReturnsInitialValueForTx_Timekeeping_Domain_Model_Role() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getRole()
		);
	}

	/**
	 * @test
	 */
	public function setRoleForTx_Timekeeping_Domain_Model_RoleSetsRole() { 
		$dummyObject = new Tx_Timekeeping_Domain_Model_Role();
		$this->fixture->setRole($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getRole()
		);
	}
	
	/**
	 * @test
	 */
	public function getTimeunitReturnsInitialValueForObjectStorageContainingTx_Timekeeping_Domain_Model_Timeunit() {
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getTimeunit()
		);
	}

	/**
	 * @test
	 */
	public function setTimeunitForObjectStorageContainingTx_Timekeeping_Domain_Model_TimeunitSetsTimeunit() {
		$timeunit = new Tx_Timekeeping_Domain_Model_Timeunit();
		$objectStorageHoldingExactlyOneTimeunit = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTimeunit->attach($timeunit);
		$this->fixture->setTimeunit($objectStorageHoldingExactlyOneTimeunit);

		$this->assertSame(
			$objectStorageHoldingExactlyOneTimeunit,
			$this->fixture->getTimeunit()
		);
	}
	
	/**
	 * @test
	 */
	public function addTimeunitToObjectStorageHoldingTimeunit() {
		$timeunit = new Tx_Timekeeping_Domain_Model_Timeunit();
		$objectStorageHoldingExactlyOneTimeunit = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTimeunit->attach($timeunit);
		$this->fixture->addTimeunit($timeunit);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneTimeunit,
			$this->fixture->getTimeunit()
		);
	}

	/**
	 * @test
	 */
	public function removeTimeunitFromObjectStorageHoldingTimeunit() {
		$timeunit = new Tx_Timekeeping_Domain_Model_Timeunit();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($timeunit);
		$localObjectStorage->detach($timeunit);
		$this->fixture->addTimeunit($timeunit);
		$this->fixture->removeTimeunit($timeunit);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getTimeunit()
		);
	}
	
}
?>