<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\SequenceAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class SequenceAttributeTest extends TestCase {

  /**
   * @var SequenceAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attr = null;
  }

  /**
   * 
   * @param string $name
   * @return AttributeInterface
   */
  public function createAttr(string $name = 'class'): AttributeInterface {
    return new SequenceAttribute($name);
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   */
  public function testConstructor() {
    $this->expectException(InvalidAttributeException::class);
    $attr = new SequenceAttribute('', []);
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
        [[]],
        [["", '']],
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider emptyData
   */
  public function testEmptySetting($value) {
    //$this->expectException(InvalidAttributeException::class);
    $this->attr->set($value);
    $this->assertCount(0, $this->attr);
    $this->assertSame(false, $this->attr->getValue());
  }

  /**
   * @return string[]
   */
  public function rawSequences(): array {
    return [
        [range('a', 'd')],
        [range(-5, 5)],
        [range(-5, 5)],
    ];
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   * @dataProvider rawSequences
   */
  public function testSetting($value) {
    $attr = new SequenceAttribute('foo');
    $attr->set($value);

    var_dump("$attr");
    $expected = 'foo="' . implode(' ', $value) . '"';
    $this->assertSame($expected, "$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @covers MultiValueAttribute::set()
   */
  public function testInvalidSetting() {
    $attr = new SequenceAttribute('foo',['maxlength'=>4, 'separator' => ',']);
    $this->expectException(InvalidAttributeException::class);
    $attr->set(range(1,10));

    var_dump("$attr");
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
