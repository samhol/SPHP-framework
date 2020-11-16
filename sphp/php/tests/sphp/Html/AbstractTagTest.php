<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\AbstractTag;
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Exceptions\HtmlException;

class AbstractTagTest extends TestCase {

  public function createObject(string $tagName, AttributeContainer $attrs = null): AbstractTag {
    $mock = $this->getMockForAbstractClass(AbstractTag::class, [$tagName, $attrs]);
    $mock->expects($this->any())
            ->method('getHtml')
            ->will($this->returnValue("value"));
    return $mock;
  }

  /**
   * @return string[]
   */
  public function constructorParameters(): array {
    $data = [];
    $data[] = ['div', null];
    $data[] = ['x', new AttributeContainer()];

    return $data;
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param string $tagName
   * @param AttributeContainer $attrs
   * @return AbstractTag
   */
  public function testConstructor(string $tagName = null, AttributeContainer $attrs = null): AbstractTag {
    $mock = $this->createObject($tagName, $attrs);
    $this->assertSame($tagName, $mock->getTagName());
    $this->expectOutputString('value');
    $mock->printHtml();
    return $mock;
  }

  /**
   * @return string[]
   */
  public function invalidConstructorParameters(): array {
    $data = [];
    $data[] = ['', null];
    $data[] = ['2', null];
    $data[] = [' ', null];

    return $data;
  }

  /**
   * @dataProvider invalidConstructorParameters
   * 
   * @param string $tagName
   * @param AttributeContainer $attrs
   * @return AbstractTag
   */
  public function testInvalidConstructorCall(string $tagName): AbstractTag {
    $this->expectException(HtmlException::class);
    $this->createObject($tagName);
  }

  /**
   * @return  AbstractTag
   */
  public function testCssClassManipulation(): AbstractTag {
    $tag = $this->createObject('div');
    $this->assertFalse($tag->hasCssClass('foo'));
    $this->assertSame($tag, $tag->addCssClass('foo'));
    $this->assertTrue($tag->hasCssClass('foo'));
    $this->assertTrue($tag->cssClasses()->contains('foo'));
    $this->assertSame($tag, $tag->removeCssClass('foo'));
    $this->assertFalse($tag->hasCssClass('foo'));
    $this->assertFalse($tag->cssClasses()->contains('foo'));
    return $tag;
  }

  /**
   * @depends testCssClassManipulation
   * @param   AbstractTag $tag
   * @return  AbstractTag
   */
  public function testAttributeManipulation(AbstractTag $tag): AbstractTag {
    $this->assertFalse($tag->attributeExists('data-foo'));
    $this->assertNull($tag->getAttribute('data-foo'));
    $this->assertSame($tag, $tag->setAttribute('data-foo', 'bar'));
    $this->assertSame('bar', $tag->getAttribute('data-foo'));
    $this->assertTrue($tag->attributeExists('data-foo'));
    $this->assertSame($tag, $tag->removeAttribute('data-foo'));
    $this->assertFalse($tag->attributeExists('data-foo'));
    return $tag;
  }

  /**
   * @return  void
   */
  public function testInlineStyleManipulation(): void {
    $attrs = new AttributeContainer();
    $attrs->styles()->setProperty('display', 'none');
    $tag = $this->createObject('div', $attrs);
    $this->assertSame($attrs->styles(), $tag->css());
  }

  /**
   * @return  void
   */
  public function testIdManipulation(): void {
    $attrs = new AttributeContainer();
    $tag = $this->createObject('div', $attrs);
    $this->assertFalse($tag->attributeExists('id'));
    $this->assertSame($tag, $tag->setId('foo'));
    $this->assertTrue($tag->attributeExists('id'));
    $this->assertSame('foo', $tag->identify(false));
    $this->assertNotSame('foo', $newId = $tag->identify(true));
    $this->assertSame($newId, $tag->getAttribute('id'));  
    $this->assertSame($tag, $tag->removeAttribute('id'));
  }
}
