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
use Sphp\Documentation\Linkers\PHP\ConstantLinker;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Reflection\ConstantReflector;

/**
 * Class ConstantLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConstantLinkerTest extends TestCase {

  protected PhpDocUrls $urlgen;

  protected function setUp(): void {
    $this->urlgen = new PhpDocUrls('/');
  }

  public function constants(): array {
    $attrs = [];
    $attrs[] = ['PHP_EOL'];
    $attrs[] = ['Sphp\Tests\Foo\FOO_CONST'];
    return $attrs;
  }

  /**
   * @dataProvider constants
   * 
   * @param  string $constant
   * @return void
   */
  public function testConstructor(string $constant): void {
    $reflection = new ConstantReflector($constant);
    $linker = new ConstantLinker($constant, $this->urlgen);
    $this->assertEquals($constant, $linker->getConstantName());
    $this->assertEquals($this->urlgen->getConstantUrl($constant), $linker->toHyperlink()->getHref());
    $this->assertEquals($reflection->getName(), $linker->getDefaultContent());
    if ($reflection->inNamespace()) {
      $this->assertEquals($reflection->getNamespaceName(), $linker->namespaceLink()->getNamespaceName());
    } else {
      $this->assertNull($linker->namespaceLink());
    }
  }

}
