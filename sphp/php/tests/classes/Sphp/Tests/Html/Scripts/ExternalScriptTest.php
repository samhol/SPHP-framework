<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Scripts;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\ExternalScript;

class ExternalScriptTest extends TestCase {

  public function testConstructor() {
    $emptySrc = new ExternalScript('foo');
    $this->assertSame('foo', $emptySrc->getSrc());
  }

  public function testScriptProperties() {
    $script = new ExternalScript('/foo.js');
    $this->assertFalse($script->isAsync());
    $this->assertFalse($script->isDefered());
    $this->assertSame($script, $script->setAsync(true));
    $this->assertTrue($script->isAsync());
    $this->assertFalse($script->isDefered());
    $this->assertSame($script, $script->setDefer(true));
    $this->assertFalse($script->isAsync());
    $this->assertTrue($script->isDefered());
  }

  public function testIntegrity() {
    $script = new ExternalScript('foo');
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
