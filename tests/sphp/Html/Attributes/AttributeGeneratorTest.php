<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\AttributeException;

class AttributeGeneratorTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var AttributeGenerator 
   */
  protected $gen;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->gen = new AttributeGenerator();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->gen = null;
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        [""],
        [" "],
        ["  "],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [[""]],
    ];
  }

  public function testTypeMapping() {
    $this->assertFalse($this->gen->isMapped('class'));
    $this->gen->mapType('class', ClassAttribute::class);
    $this->assertTrue($this->gen->isMapped('class'));
    $object = $this->gen->createObject('class');
    $this->assertInstanceOf(ClassAttribute::class, $object);
    $this->expectException(AttributeException::class);
    $this->gen->mapType('class', GeneralAttribute::class);
  }

  public function testSubTyping() {
    $this->assertFalse($this->gen->isMapped('foo'));
    $this->gen->mapType('foo', PatternAttribute::class, '/^foobar*$/');
    $this->assertTrue($this->gen->isMapped('foo'));
    $object = $this->gen->createObject('foo');
    $this->assertInstanceOf(PatternAttribute::class, $object);
    $this->gen->mapType('foo', IdAttribute::class);
    $object1 = $this->gen->createObject('foo');
    $this->assertInstanceOf(PatternAttribute::class, $object1);
    $this->assertInstanceOf(IdAttribute::class, $object1);
    $this->expectException(AttributeException::class);
    $this->gen->mapType('foo', GeneralAttribute::class);
  }

}
