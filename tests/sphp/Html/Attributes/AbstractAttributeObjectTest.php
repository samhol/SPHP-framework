<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

abstract class AbstractAttributeObjectTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var AttributeInterface 
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
   * @return AttributeInterface
   */
  abstract public function createAttr(string $name = 'data-attr'): AttributeInterface;


  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attr->demand();
    $this->assertTrue($this->attr->isDemanded());
    $this->attr->set(false);
    $this->attr->clear();
    $this->assertTrue($this->attr->isDemanded());
    $this->assertEquals("$this->attr", $this->attr->getName() . "");
  }


}
