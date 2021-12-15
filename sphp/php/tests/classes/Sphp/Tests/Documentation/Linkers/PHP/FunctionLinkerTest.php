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

use Sphp\Documentation\Linkers\PHP\FunctionLinker;
use PHPUnit\Framework\TestCase;
use ReflectionFunction;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;

/**
 * Implements test for a FunctionLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FunctionLinkerTest extends TestCase {

  protected PhpDocUrls $urlgen;

  protected function setUp(): void {
    $this->urlgen = new PhpDocUrls('/');
  }

  public function functionNames(): array {
    $attrs = [];
    $attrs[] = ['array_key_exists'];
    $attrs[] = ['abs'];
    $attrs[] = ['Sphp\Tests\Foo\foo'];
    return $attrs;
  }

  /**
   * @dataProvider functionNames
   * @param string $function
   * @return void
   */
  public function testConstructor(string $function): void {
    $reflection = new ReflectionFunction($function);
    $linker = new FunctionLinker($function, $this->urlgen);
    //$altLinker = new BasicFunctionLinker("$function()", $this->urlgen);
    // $this->assertEquals($linker, $altLinker);
    $this->assertEquals($function, $linker->getFunctionName());
    $this->assertEquals($this->urlgen->getFunctionUrl($function), $linker->toHyperlink()->getHref());
    if ($reflection->inNamespace()) {
      $this->assertEquals($reflection->getNamespaceName(), $linker->namespaceLink()->getNamespaceName());
    } else {
      $this->assertNull($linker->namespaceLink());
    }
  }

}
