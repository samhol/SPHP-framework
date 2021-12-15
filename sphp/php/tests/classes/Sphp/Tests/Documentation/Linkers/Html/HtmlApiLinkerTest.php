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
use Sphp\Documentation\Linkers\Html\TagLinker;
use Sphp\Documentation\Linkers\Html\AttributeLinker;
use Sphp\Documentation\Linkers\Html\HtmlApiLinker;
use Sphp\Documentation\Linkers\Html\W3schoolsURLs;

/**
 * Class HtmlApiLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HtmlApiLinkerTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructor(): void {
    $api = new HtmlApiLinker(new W3schoolsURLs());
    $linker = $api->createGlobalAttrLink('title');
    $this->assertEquals($linker->getDefaultContent(), $linker->toHyperlink()->contentToString());
  }

  /**
   * @return void
   */
  public function testMagicGet(): void {
    $api = new HtmlApiLinker(new W3schoolsURLs());
    $attrLinker = $api->html->title;
    $this->assertEquals($attrLinker->getDefaultContent(), $attrLinker->toHyperlink()->contentToString());
    $this->assertEquals($attrLinker->getUrl(), $attrLinker->toHyperlink()->getHref());
    $this->assertEquals($api->createTagLink('html'), $api->html);
    $this->assertEquals($api->createTagLink('html'), $api('html'));
  }

  public function getUrlData(): iterable {
    yield [AttributeLinker::class, null, 'accept'];
    yield [TagLinker::class, 'a', null];
    yield [AttributeLinker::class, 'a', 'href'];
    yield [HtmlApiLinker::class, null, null];
  }

  /**
   * @dataProvider getUrlData
   *  
   * @param  string $expected
   * @param  string|null $tagName
   * @param  string|null $attrName
   * @return void
   */
  public function testMagicInvoke(string $expected, ?string $tagName = null, ?string $attrName = null): void {
    $api = new HtmlApiLinker(new W3schoolsURLs());
    $this->assertInstanceOf($expected, $api($tagName, $attrName));
  }

}
