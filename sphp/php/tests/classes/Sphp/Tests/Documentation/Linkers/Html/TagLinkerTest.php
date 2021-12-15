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
use Sphp\Documentation\Linkers\Html\W3schoolsURLs;

/**
 * Class TagLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TagLinkerTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructor(): void {
    $linker = new TagLinker('a', new W3schoolsURLs());
    $a = $linker->toHyperlink();
    $this->assertEquals($linker->getDefaultContent(), $a->contentToString());
  }

  public function nameMap(): array {
    $data = [];
    $data [] = ['title'];
    $data [] = ['foo'];
    return $data;
  }

  /**
   * @dataProvider nameMap
   * 
   * @param  string|null $content
   * @return void
   */
  public function testInvoke(string $content = null): void {
    $linker = new TagLinker('a', new W3schoolsURLs());
    $this->assertEquals($linker->createAttrLink($content), $linker($content));
  }

}
