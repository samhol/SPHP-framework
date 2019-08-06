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

class ScriptSrcTest extends TestCase {

  public function testConstructor() {
    $emptySrc = new ScriptSrc();
    $this->assertSame(null, $emptySrc->getSrc());
  }

  public function testIntegrity() {
    $script = new ScriptSrc();
    $this->assertFalse($script->attributeExists('integrity'));
    $this->assertFalse($script->attributeExists('crossorigin'));
    $this->assertSame($script, $script->setIntegrity('hash'));
    $this->assertTrue($script->attributeExists('integrity'));
    $this->assertSame('hash', $script->getAttribute('integrity'));
    $this->assertSame('anonymous', $script->getAttribute('crossorigin'));
    $this->assertSame($script, $script->setIntegrity(null));
    $this->assertFalse($script->attributeExists('integrity'));
    $this->assertFalse($script->attributeExists('crossorigin'));
  }

}
