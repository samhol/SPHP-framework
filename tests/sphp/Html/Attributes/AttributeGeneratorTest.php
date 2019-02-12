<?php

namespace Sphp\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class AttributeGeneratorTest extends TestCase {

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
    $gen = new AttributeGenerator();
    $this->assertFalse($gen->isMapped('class'));
    $gen->mapType('class', ClassAttribute::class);
    $this->assertTrue($gen->isMapped('class'));
    $object = $gen->createObject('class');
    $this->assertInstanceOf(ClassAttribute::class, $object);
    $this->expectException(InvalidArgumentException::class);
    $gen->mapType('class', GeneralAttribute::class);
  }

  public function testSubTyping() {
    $gen = new AttributeGenerator();
    $this->assertFalse($gen->isMapped('foo'));
    $gen->mapType('foo', PatternAttribute::class, '/^foobar*$/');
    $this->assertTrue($gen->isMapped('foo'));
    $object = $gen->createObject('foo');
    $this->assertInstanceOf(PatternAttribute::class, $object);
    $gen->mapType('foo', IdAttribute::class);
    $object1 = $gen->createObject('foo');
    $this->assertInstanceOf(PatternAttribute::class, $object1);
    $this->assertInstanceOf(IdAttribute::class, $object1);
    $this->expectException(InvalidArgumentException::class);
    $gen->mapType('foo', GeneralAttribute::class);
  }

}
