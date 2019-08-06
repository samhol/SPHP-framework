<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of AbstractScriptTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AbstractScriptTagTest extends TestCase {

  public function createScript(): AbstractScriptTag {
    $script = $this->getMockForAbstractClass(AbstractScriptTag::class);
    $script->expects($this->any())
            ->method('contentToString')
            ->will($this->returnValue(''));
    return $script;
  }

  public function testScriptType() {
    $script = $this->createScript();
    $this->assertFalse($script->attributeExists('type'));
    $this->assertSame($script, $script->setType('application/javascript'));
    $this->assertTrue($script->attributeExists('type'));
    $this->assertSame('application/javascript', $script->getAttribute('type'));
  }

  public function testScriptProperties() {
    $script = $this->createScript();
    $this->assertFalse($script->isAsync());
    $this->assertFalse($script->isDefered());
    $this->assertSame($script, $script->setAsync(true));
    $this->assertTrue($script->isAsync());
    $this->assertFalse($script->isDefered());
    $this->assertSame($script, $script->setDefer(true));
    $this->assertFalse($script->isAsync());
    $this->assertTrue($script->isDefered());
  }

}
