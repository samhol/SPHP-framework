<?php

namespace Sphp\Html\Foundation\Structure;

class ColumnPropsTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Column
	 */
	protected $c1;

	/**
	 * @var Column
	 */
	protected $c2;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->c1 = new Column(1, 2, 3);
		$this->c2 = new Column();
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	private function reset() {
		$this->c1->resetGridSettings();
		$this->c2->resetGridSettings();
	}

	private static $screens = [
		"small" => Column::SMALL_SCREENS,
		"medium" => ColumnProps::MEDIUM_SCREENS,
		"large" => Column::LARGE_SCREENS
	];

	public function testGetScreenType() {
		foreach (self::$screens as $name => $int) {
			$this->assertEquals(Column::getScreenName($name), $name);
			$this->assertEquals(Column::getScreenName($int), $name);
		}
		$this->assertTrue(Column::getScreenName("") === NULL);
		$this->assertTrue(Column::getScreenName(NULL) === NULL);
		$this->assertTrue(Column::getScreenName(0) === NULL);
	}

	private static $allTypes = [
		0b1 => [0b1],
		0b10 => [0b10],
		0b100 => [0b100],
		0b11 => [0b1, 0b10],
		0b110 => [0b10, 0b100],
		0b101 => [0b1, 0b100],
		0b111 => [0b1, 0b10, 0b100],
		"small" => [0b1],
		"small medium" => [0b1, 0b10],
		"small large" => [0b1, 0b100],
		"medium large" => [0b10, 0b100],
		"small medium large" => [0b1, 0b10, 0b100],
		"medium small large" => [0b1, 0b10, 0b100],
	];

	public function t1estParseScreentype() {
		$this->reset();
		foreach (self::$allTypes as $toParse => $parsed) {
			$this->assertEquals(Column::parseScreens($toParse), $parsed);
		}
	}

	public function widthOffsetMatch() {
		foreach (self::$screens as $name => $id) {
			$this->assertTrue(($this->c1->getWidth($name) + $this->c1->getGridOffset($name)) === $this->c1->countUsedSpace($name));
			$this->assertTrue(($this->c2->getWidth($name) + $this->c2->getGridOffset($name)) === $this->c2->countUsedSpace($name));
		}
	}

	public function testWidths() {
		$this->reset();
		$this->c1->setWidths(2, 4, 6);
		$this->testWidth1(2, 4, 6);
		$this->c1->resetGridSettings();
		$this->testWidth1(1, 1, 1);
		$this->c1->setWidth(4, "medium");
		$this->testWidth1(1, 4, 4);
		$this->c1->setWidth(4, "large")
				->setWidthInherited("medium")
				->setWidth(12, "small");
		$this->testWidth1(12, 12, 4);
	}

	
	
	private function testWidth1($s, $m, $l) {
		$this->assertTrue($this->c1->getWidth("small") === $s);
		$this->assertTrue($this->c1->getWidth("medium") === $m);
		$this->assertTrue($this->c1->getWidth("large") === $l);
	}

	private function testSpaceUsed1($s, $m, $l) {
		$this->assertTrue($this->c1->countUsedSpace("small") === $s);
		$this->assertTrue($this->c1->countUsedSpace("medium") === $m);
		$this->assertTrue($this->c1->countUsedSpace("large") === $l);
	}

	public function testOffset() {
		$this->reset();
		$this->c1->setGridOffsets(2, 4, 6);
		$this->testSpaceUsed1(3, 5, 7);
	}

	public function te1stSetting() {
		$this->c1->setGridOffset(1, "small");
		//print_r($this->val_1); 
		$this->assertEquals($this->c1->setWidth(11, "small large")->countUsedSpace("small"), 12);

		$this->assertEquals($this->c1->getWidth(Column::MEDIUM_SCREENS), 6);
		$this->assertTrue($this->c1->getWidth(Column::LARGE_SCREENS) === 11);
		$this->assertEquals($this->c2->getWidth(Column::SMALL_SCREENS), 12);
		$this->assertEquals($this->c2->getWidth(Column::MEDIUM_SCREENS), 12);
		$this->assertEquals($this->c2->getWidth(Column::LARGE_SCREENS), 5);
	}

}
