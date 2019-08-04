<?php

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;

class AbstractTagTest extends TestCase {

  public function testConstructor(): AbstractTag {
    $mock = $this->getMockForAbstractClass(AbstractTag::class, ['div']);
    $mock->expects($this->any())
            ->method('getHtml')
            ->will($this->returnValue('value'));
    $this->expectOutputString('value');
    $mock->printHtml();
    return $mock;
  }

  /**
   * @depends testConstructor
   * @param   AbstractTag $tag
   * @return  AbstractTag
   */
  public function testCssClassManipulation(AbstractTag $tag): AbstractTag {
    $this->assertFalse($tag->hasCssClass('foo'));
    $this->assertSame($tag, $tag->addCssClass('foo'));
    $this->assertTrue($tag->hasCssClass('foo'));
    $this->assertSame($tag, $tag->removeCssClass('foo'));
    $this->assertFalse($tag->hasCssClass('foo'));
    return $tag;
  }

  /**
   * @depends testCssClassManipulation
   * @param   AbstractTag $tag
   * @return  AbstractTag
   */
  public function testAttributeManipulation(AbstractTag $tag): AbstractTag {
    $this->assertFalse($tag->attributeExists('data-foo'));
    $this->assertSame($tag, $tag->setAttribute('data-foo', 'bar'));
    $this->assertTrue($tag->attributeExists('data-foo'));
    $this->assertSame($tag, $tag->removeAttribute('data-foo'));
    $this->assertFalse($tag->attributeExists('data-foo'));
    return $tag;
  }

}
