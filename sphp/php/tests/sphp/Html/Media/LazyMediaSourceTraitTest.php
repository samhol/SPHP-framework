<?php

namespace Sphp\Tests\Html\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\LazyMediaSourceTrait;
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Media\LazyMedia;
class LazyMediaSourceTraitTest extends TestCase {

  protected $mock;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  public function testTraitBase() {
    $trait = $this->getMockForTrait(LazyMediaSourceTrait::class);
    $mngr = new AttributeContainer();
    $trait->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
    $this->assertFalse($trait->isLazy());
    return $trait;
  }

  /**
   * @depends testTraitBase
   * 
   * @param type $trait
   */
  public function testNotLazy($trait) {
    $src = 'foo.bar';
    $this->assertFalse($trait->isLazy());
    $trait->setSrc($src);
    $this->assertSame($trait, $trait->setLazy(true));
    $this->assertTrue($trait->isLazy());
    $this->assertSame($src, $trait->attributes()->getValue('data-src'));
    $this->assertSame($src, $trait->getSrc());
    $this->assertFalse($trait->attributes()->isVisible('src'));
  }

  public function srcSettingAndGetting(string $src) {
    $this->assertSame($this->mock, $this->mock->setSrc($src));
    if ($this->mock->isLazy()) {
      $this->assertSame($src, $this->mock->attributes()->getValue('data-src'));
      $this->assertSame($src, $this->mock->getSrc());
      $this->assertFalse($this->mock->attributes()->isVisible('src'));
    } else {
      $this->assertSame($src, $this->mock->attributes()->getValue('src'));
      $this->assertSame($src, $this->mock->getSrc());
      $this->assertSame(null, $this->mock->attributes()->getValue('data-src'));
    }
  }

}
