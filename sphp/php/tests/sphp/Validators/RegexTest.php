<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of RegexTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class RegexTest extends TestCase {

  public function testWithSkip() {
    $regex = new Regex('/foo/', 'Foo is bar');
    $this->assertTrue($regex->isValid('foop'));
    $this->assertCount(0, $regex->errorsToArray());
    $this->assertFalse($regex->isValid('fo op'));
    $this->assertContains('Foo is bar', $regex->errorsToArray());
    $this->assertSame($regex, $regex->skip(null));
    $this->assertTrue($regex->isValid(null));
    $this->assertFalse($regex->isValid('fo op'));
  }

}
