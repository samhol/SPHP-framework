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
 * Email validation testing
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class EmailTest extends TestCase {

  public function testWithSkip() {
    $validator = new Email('Email fails badly');
    $this->assertTrue($validator->isValid('sami.holck@gmail.com'));
    $this->assertCount(0, $validator->errorsToArray());
    $this->assertFalse($validator->isValid('foo'));
    $this->assertContains('Email fails badly', $validator->errorsToArray());
  }

}
