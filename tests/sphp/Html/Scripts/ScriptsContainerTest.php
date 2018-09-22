<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use PHPUnit\Framework\TestCase;

class ScriptsContainerTest extends TestCase {

  /**
   * 
   * @return ScriptsContainer
   */
  public function testConstructor(): ScriptsContainer {
    $scripts = new ScriptsContainer();
    $this->assertSame('', "$scripts");
    $this->assertCount(0, $scripts);
    return $scripts;
  }

  /**
   * @depends testConstructor
   * 
   * @param  ScriptsContainer $scripts
   * @return ScriptsContainer
   */
  public function testAppending(ScriptsContainer $scripts): ScriptsContainer {
    $script[0] = new ScriptSrc('foo.js');
    $this->assertFalse($scripts->contains($script[0]));
    $this->assertSame($scripts, $scripts->append($script[0]));
    $this->assertCount(1, $scripts);
    $this->assertTrue($scripts->contains($script[0]));
    $script[1] = $scripts->appendCode('var $foo = 2;');
    $this->assertCount(2, $scripts);
    $this->assertTrue($scripts->contains($script[1]));
    $script[2] = $scripts->appendSrc('foo1.js');
    $this->assertCount(3, $scripts);
    $this->assertTrue($scripts->contains($script[2]));
    foreach ($scripts as $index => $s) {
      $this->assertSame($script[$index], $s);
    }
    return $scripts;
  }

}
