<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\Html\AttributeLinker;
use Sphp\Documentation\Linkers\Html\W3schoolsURLs;

/**
 * Class AttributeLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AttributeLinkerTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructor(): void {
    $tagAttrLinker = new AttributeLinker('href', 'a', new W3schoolsURLs());
    $this->assertFalse($tagAttrLinker->isGlobalAttribute());
    $factory = new AttributeLinker('onmouseout', null, new W3schoolsURLs());
    $this->assertTrue($factory->isGlobalAttribute());
  }

  /**
   * @return void
   */
  public function testGlobalAttributeConstructor(): void {
    $attrName = 'onmouseout';
    $tagAttrLinker = new AttributeLinker($attrName, null, $gen = new W3schoolsURLs());
    $a = $tagAttrLinker->toHyperlink();
    $this->assertEquals($tagAttrLinker->getDefaultContent(), $a->contentToString());
    $this->assertEquals($tagAttrLinker->getUrl(), $a->getHref());
    $this->assertEquals($gen->getGlobalAttrUrl($attrName), $a->getHref());
  }

  /**
   * @return void
   */
  public function testAttributeConstructor(): void {
    $tagAttrLinker = new AttributeLinker('href', 'a', new W3schoolsURLs());
    $a = $tagAttrLinker->toHyperlink();
    $this->assertEquals($tagAttrLinker->getDefaultContent(), $a->contentToString());
    $this->assertEquals($tagAttrLinker->getUrl(), $a->getHref());
  }
  /**
   * @return void
   */
  public function testInvoke(): void {
    $tagAttrLinker = new AttributeLinker('href', 'a', new W3schoolsURLs());
    $a = $tagAttrLinker();
    $this->assertEquals($tagAttrLinker->getDefaultContent(), $a->contentToString());
    $this->assertEquals($tagAttrLinker->getUrl(), $a->getHref());
  }

}
