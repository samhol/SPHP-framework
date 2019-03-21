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

class ScriptTagTest extends TestCase {

  public function testConstructors() {
    $emptySrc = new ScriptSrc();
    $this->assertSame('', $emptySrc->getSrc());
    $emptyCode = new ScriptCode();

    $this->assertSame('<script></script>', "$emptyCode");
  }

}
