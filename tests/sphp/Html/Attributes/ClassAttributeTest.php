<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Attribute;
use Sphp\Html\Attributes\ClassAttribute;

class ClassAttributeTest extends TestCase {

  /**
   * @var ClassAttribute 
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

  public function createAttr(string $name = 'class'): Attribute {
    return new ClassAttribute($name);
  }

  /**
   * @return string[]
   */
  public function identicalSets(): array {
    return [
        [['a', 'b', 'c'], 'b c a'],
        [['a', 'b', 'c'], ['a b', 'c']],
        [['a', 'b', 'c'], [['a b'], 'c']],
    ];
  }

  /**
   * @dataProvider identicalSets
   * @param array $setA
   * @param string|array $setB
   */
  public function testIdenticalSets(array $setA, $setB) {
    $a = new ClassAttribute('a');
    $a->set($setA);
    $b = new ClassAttribute('b');
    $b->set($setB);
    $this->assertTrue($a->contains($setA));
    $this->assertTrue($b->contains($setA));
    $this->assertTrue($a->contains($setB));
    $this->assertTrue($b->contains($setB));
    foreach ($setA as $item) {
      $this->assertTrue($a->contains($item));
      $this->assertTrue($b->contains($item));
    }
  }

  /**
   * @return string[]
   */
  public function invalidValues(): array {
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

  /**
   * 
   * @return string[]
   */
  public function scalarData(): array {
    return [
        ['', false, false],
        [' ', false, false],
        ['foo', 'foo', true],
        ['bar', 'bar', true],
        ['value1', 'value1', true],
        [' value2 ', 'value2', true],
        [0, 0, true],
        [-1, -1, true],
        [1, 1, true],
        [0b100, 0b100, true]
    ];
  }

  /**
   * @return string[]
   */
  public function settingData(): array {
    return [
        range('a', 'd'),
        ['_-'],
        ['a b c']
    ];
  }

  /**
   * @dataProvider settingData
   */
  public function testSetMethod($value) {
    $this->attr->set($value);
    //var_dump($attr->isDemanded() || boolval($value));

    $this->assertFalse($this->attr->isProtected());
    $this->assertFalse($this->attr->isProtected($value));
    $this->assertFalse($this->attr->isDemanded());
    $this->assertFalse($this->attr->isEmpty());
    //$this->assertEquals($this->attrs->getValue(), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function lockingData(): array {
    return [
        ['c1'],
        [["c1", 'c2']],
        [['c1', 'c2', 'c3']]
    ];
  }

  /**
   * @dataProvider lockingData
   */
  public function testProtectMethod($value) {
    $this->attr->protect($value);
    $this->assertTrue($this->attr->isProtected($value));
    $this->assertTrue($this->attr->isProtected());
    $this->assertTrue($this->attr->contains($value));
  }

  /**
   * 
   * @return string[]
   */
  public function addingData(): array {
    return [
        [["c1", 'a_1']],
        [range('a', 'e')],
        [range('a', 'e')]
    ];
  }

  /**
   * 
   * @param string $value numeric value
   * @param int $num
   * @dataProvider addingData
   */
  public function testAddMethod($value) {
    $this->attr->add($value);
    $this->assertTrue($this->attr->contains($value));
    $this->assertCount(count($value), $this->attr);
    $this->attr->clear();
    $this->assertCount(0, $this->attr);
  }

  protected function attrContains(MultiValueAttribute $attr, $values) {
    foreach (is_array($values) ? $values : [$values] as $value) {
      $this->assertTrue($attr->contains($value));
    }
  }

  /**
   * 
   * @return scalar[]
   */
  public function clearingData(): array {
    return [
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   */
  public function testClearMethod() {
    $this->attr->add('a', 'b');
    $this->assertTrue($this->attr->contains('a', 'b'));
    $this->attr->clear();
    $this->assertFalse($this->attr->contains('a', 'b'));
    $this->assertFalse($this->attr->contains('a'));
    $this->assertFalse($this->attr->contains('b'));
    $this->attr->protect('a');
    $this->attr->clear();
    $this->assertTrue($this->attr->contains('a'));
  }

  /**
   * 
   * @return scalar[]
   */
  public function removingData(): array {
    return [
        ["c1", "", 0],
        ["c1", "l1", 1],
        ["c1 c2 c2", "li l2", 2],
        [["c1", "c2", "c3", "c3"], ["l1", "l2", "l3", "l3"], 3]
    ];
  }

  /**
   * @param string $add
   * @param string $lock
   * @param int $count
   */
  public function testRemoving() {
    $this->attr->add("foo", "bar");
    $this->assertTrue($this->attr->contains("foo", 'bar'));
    $this->attr->remove("bar");
    $this->assertTrue($this->attr->contains("foo"));
    $this->assertFalse($this->attr->contains("bar"));
    $this->attr->protect("bar");
    //$this->expectException(ImmutableAttributeException::class);
    //$this->attrs->remove("bar");
  }

  public function protectedData(): array {
    return [
        ["a"],
        ["a b c"],
        [['a', 'b', 'c']]
    ];
  }

  /**
   * @param  scalar $value
   */
  public function testValueProtecting() {
    $this->assertFalse($this->attr->isProtected());
    $this->attr->protect('a b');
    $this->attr->protect('c', ['d']);
    $this->attr->protect([['e', ['f']]]);
    $this->attr->clear();
    $this->assertCount(6, $this->attr);
    $this->assertTrue($this->attr->isProtected());
    $this->assertTrue($this->attr->isProtected('a'));
    $this->assertTrue($this->attr->isProtected('b'));
    $this->assertTrue($this->attr->isProtected('c', 'a'));
    $this->assertTrue($this->attr->isProtected(['a', 'c']));
    $this->assertTrue($this->attr->isProtected('a b c e '));
    $this->assertFalse($this->attr->isProtected('a b c e foo'));
    $this->assertFalse($this->attr->isProtected('foo'));
    $this->assertFalse($this->attr->isProtected(''));
  }

  /**
   */
  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
    $this->attr->set('a');
    $this->assertEquals("$this->attr", 'class="a"');
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName());
  }

}
