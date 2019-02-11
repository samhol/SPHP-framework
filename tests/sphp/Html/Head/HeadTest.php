<?php

namespace Sphp\Html\Head;

use PHPUnit\Framework\TestCase;

class HeadTest extends TestCase {

  /**
   * @var Head
   */
  protected $head;

  /**
   * @return Head
   */
  public function createContainer(): Head {
    return new Head();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->head = $this->createContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->head);
    parent::tearDown();
  }

  public function testConstructor() {
    $head = new Head();
    $this->assertSame("$head", "<head></head>");
    $head1 = new Head('title', 'utf-8');
    $this->assertCount(1, $head1->getComponentsByObjectType(Title::class));
    $this->assertCount(1, $head1->getComponentsByObjectType(MetaTag::class));
    
  }
  
  public function testBaseAddress() {
    $base = $this->head->setBaseAddr('http://foo.bar', '_blank');
    $base1 = new Base('http://foo.bar', '_blank');
    $this->assertTrue($base1 == $base);
    $this->assertCount(1, $this->head->getComponentsByObjectType(Base::class));
  }

}
