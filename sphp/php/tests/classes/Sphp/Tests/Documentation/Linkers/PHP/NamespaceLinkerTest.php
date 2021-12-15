<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\NamespaceLinker;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Html\Navigation\A;

/**
 * Class NamespaceLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NamespaceLinkerTest extends TestCase {

  public function namespaceMap(): array {
    $attrs = [];
    $attrs[] = ["Sphp\\bar"];
    return $attrs;
  }

  /**
   * @dataProvider namespaceMap
   * 
   * @param  string $ns
   * @return void
   */
  public function testConstructor(string $ns): void {
    $linker = new NamespaceLinker($ns, $urlgen = new PhpDocUrls('/foo/'));
    $this->assertEquals($ns, $linker->getNamespaceName());
    $this->assertEquals($urlgen->getNamespaceUrl($ns), $linker->toHyperlink()->getHref());
  }
  /**
   * @dataProvider namespaceMap
   * 
   * @param  string $ns
   * @return void
   */
  public function testInvalidNamespaces(string $ns): void {
    $linker = new NamespaceLinker($ns, $urlgen = new PhpDocUrls('/foo/'));
    $this->assertEquals($ns, $linker->getNamespaceName());
    $this->assertEquals($urlgen->getNamespaceUrl($ns), $linker->toHyperlink()->getHref());
  }

  public function testGetTrail(): void {
    $ns = 'Sphp\\bar';
    $linker = new NamespaceLinker($ns, $urlgen = new PhpDocUrls('/foo/'));
    foreach ($linker as $subLinker) {
      $this->assertInstanceof(NamespaceLinker::class, $subLinker);
      $this->assertEquals($urlgen->getNamespaceUrl($subLinker->getNamespaceName()), $subLinker->toHyperlink()->getHref());
    }
  }

  public function testNavBars(): void {
    $ns = 'Sphp\\bar';
    $linker = new NamespaceLinker($ns, $urlgen = new PhpDocUrls('/foo/'));
    $arr = $linker->toArray();
    $inlineNavBar = $linker->toInlineNavBar();
    $links = $inlineNavBar->getComponentsByObjectType(A::class);
    $navBar = $linker->toNavBar();
    //print_r($links); 
    foreach ($links as $k => $link) {
      $this->assertEquals($arr[$k]->toShortLink(), $link);
    }
    $this->assertEquals($links, $navBar->getComponentsByObjectType(A::class));
  }

}
