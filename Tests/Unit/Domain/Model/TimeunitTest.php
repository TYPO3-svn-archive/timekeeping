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
 * Test case for class Tx_Timekeeping_Domain_Model_Timeunit.
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
class Tx_Timekeeping_Domain_Model_TimeunitTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Timekeeping_Domain_Model_Timeunit
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Timekeeping_Domain_Model_Timeunit();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getDateOfWorkReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setDateOfWorkForDateTimeUnitsDateOfWork() { }
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getDurationReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getDuration()
		);
	}

	/**
	 * @test
	 */
	public function setDurationForFloatSetsDuration() { 
		$this->fixture->setDuration(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getDuration()
		);
	}
	
	/**
	 * @test
	 */
	public function getCleaningReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getCleaning()
		);
	}

	/**
	 * @test
	 */
	public function setCleaningForBooleanSetsCleaning() { 
		$this->fixture->setCleaning(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getCleaning()
		);
	}
	
	/**
	 * @test
	 */
	public function getAssignmentReturnsInitialValueForObjectStorageContainingTx_Timekeeping_Domain_Model_Assignment() {
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAssignment()
		);
	}

	/**
	 * @test
	 */
	public function setAssignmentForObjectStorageContainingTx_Timekeeping_Domain_Model_AssignmentSetsAssignment() {
		$assignment = new Tx_Timekeeping_Domain_Model_Assignment();
		$objectStorageHoldingExactlyOneAssignment = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAssignment->attach($assignment);
		$this->fixture->setAssignment($objectStorageHoldingExactlyOneAssignment);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAssignment,
			$this->fixture->getAssignment()
		);
	}
	
	/**
	 * @test
	 */
	public function addAssignmentToObjectStorageHoldingAssignment() {
		$assignment = new Tx_Timekeeping_Domain_Model_Assignment();
		$objectStorageHoldingExactlyOneAssignment = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAssignment->attach($assignment);
		$this->fixture->addAssignment($assignment);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAssignment,
			$this->fixture->getAssignment()
		);
	}

	/**
	 * @test
	 */
	public function removeAssignmentFromObjectStorageHoldingAssignment() {
		$assignment = new Tx_Timekeeping_Domain_Model_Assignment();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($assignment);
		$localObjectStorage->detach($assignment);
		$this->fixture->addAssignment($assignment);
		$this->fixture->removeAssignment($assignment);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAssignment()
		);
	}
	
}
?>