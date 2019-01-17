<?php

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\Attribute;

abstract class AbstractAttributeObjectTest extends TestCase {

  /**
   * @var Attribute 
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
   * @return Attribute
   */
  abstract public function createAttr(string $name = 'data-attr'): Attribute;

  /**
   * @return Attribute
   */
  abstract public function getValues(string $name = 'data-attr');

  /**
   * @return Attribute
   */
  public function testDemanding(): Attribute {
    //echo "\ntestCloning()\n";
    $attr = $this->createAttr('attr');
    $this->assertFalse($attr->isDemanded());
    $attr->demand();
    $this->assertTrue($attr->isDemanded());
    $this->assertSame("$attr", 'attr');
    $attr->setValue(false);
    $this->assertTrue($attr->isDemanded());
    $attr->setValue(null);
    $this->assertTrue($attr->isDemanded());
    $attr->clear();
    $this->assertTrue($attr->isDemanded());
    return $attr;
  }

}
