<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\HyperlinkFactory;

/**
 * Class URLtemplateBuilderTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HyperlinkFactoryrTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructor(): void {
    $factory = new HyperlinkFactory();
    $this->assertEmpty($factory->getAttributes());
    $hyperlink = $factory->buildHyperlink('/foo.bar');
    $this->assertNull($hyperlink->getRelationship());
    $this->assertNull($hyperlink->getTarget());
    $this->assertSame('/foo.bar', $hyperlink->getHref());
  }

  /**
   * @return HyperlinkFactory
   */
  public function testUseHyperlinkOptions(): HyperlinkFactory {
    $factory = new HyperlinkFactory();
    $this->assertSame($factory, $factory->useRel('help'));
    $this->assertSame($factory, $factory->useTarget('foo'));
    $hyperlink = $factory->buildHyperlink('/foo.bar');
    $this->assertSame('help', $hyperlink->getRelationship());
    $this->assertSame('foo', $hyperlink->getTarget());
    $this->assertSame('/foo.bar', $hyperlink->getHref());
    return $factory;
  }

  /**
   * @depends testUseHyperlinkOptions
   * 
   * @param  HyperlinkFactory $factory
   * @return HyperlinkFactory
   */
  public function testUseCssClasses(HyperlinkFactory $factory): HyperlinkFactory {
    $this->assertSame($factory, $factory->useCssClass('a', 'b'));
    $hyperlink = $factory->buildHyperlink('/foo.bar');
    $this->assertSame('/foo.bar', $hyperlink->getHref());
    $this->assertTrue($hyperlink->hasCssClass('a', 'b'));
    $this->assertSame($factory, $factory->useCssClass('c'));
    $this->assertSame($factory, $factory->removeCssClass('b'));
    $hyperlink1 = $factory->buildHyperlink('/bar.baz');
    $this->assertSame('/bar.baz', $hyperlink1->getHref());
    $this->assertTrue($hyperlink1->hasCssClass('a', 'c'));
    $this->assertFalse($hyperlink1->hasCssClass('b'));
    return $factory;
  }


  /**
   * @depends testUseHyperlinkOptions
   * 
   * @param  HyperlinkFactory $factory
   * @return HyperlinkFactory
   */
  public function testClone(HyperlinkFactory $factory): void {
    $clone = clone $factory;
    $this->assertNotSame($factory, $clone);
    $this->assertSame($clone, $clone->removeCssClass('a'));
    $hyperlink = $factory->buildHyperlink('/foobar');
    $this->assertSame('/foobar', $hyperlink->getHref());
    $this->assertTrue($hyperlink->hasCssClass('c'));
  }
}
