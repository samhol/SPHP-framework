<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\AttributeInterface;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

abstract class AbstractAttributeObjectTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var AttributeInterface 
   */
  protected $attrs;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attrs = $this->createAttr();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attrs = null;
  }

  /**
   * @return AttributeInterface
   */
  abstract public function createAttr(string $name = 'data-attr'): AttributeInterface;


  /**
   * @covers AbstractAttribute::isDemanded()
   */
  public function testDemanding() {
    $this->attrs->demand();
    $this->assertTrue($this->attrs->isDemanded());
    $this->attrs->set(false);
    $this->attrs->clear();
    $this->assertTrue($this->attrs->isDemanded());
    $this->assertEquals("$this->attrs", $this->attrs->getName() . "");
  }


}
