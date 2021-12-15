<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Validators\Regex;

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
    $this->assertCount(0, $regex->getErrors());
    $this->assertFalse($regex->isValid('fo op'));
    $this->assertContains('Foo is bar', $regex->getErrors());
    $this->assertSame($regex, $regex->skip(null));
    $this->assertTrue($regex->isValid(null));
    $this->assertFalse($regex->isValid('fo op'));
  }

}
