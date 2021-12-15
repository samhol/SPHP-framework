<?php

namespace Sphp\Tests\Html\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\SizeableMediaTrait;
use Sphp\Html\Attributes\AttributeContainer;

class SizeableMediaTraitTest extends TestCase {

  public function testSetSize(): void {
    $trait = $this->getMockForTrait(SizeableMediaTrait::class);
    $mngr = new AttributeContainer();
    $trait->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
    $this->assertSame(null, $trait->attributes()->getValue('width'));
    $this->assertSame(null, $trait->attributes()->getValue('height'));
    $this->assertSame($trait, $trait->setSize(100, 200));
    $this->assertSame(100, $trait->attributes()->getValue('width'));
    $this->assertSame(200, $trait->attributes()->getValue('height'));
    $this->assertSame($trait, $trait->setSize(100, null));
    $this->assertSame(100, $trait->attributes()->getValue('width'));
    $this->assertSame(null, $trait->attributes()->getValue('height'));
    $this->assertSame($trait, $trait->setSize(null, 200));
    $this->assertSame(null, $trait->attributes()->getValue('width'));
    $this->assertSame(200, $trait->attributes()->getValue('height'));
  }

}
