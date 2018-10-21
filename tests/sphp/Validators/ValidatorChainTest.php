<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

class ValidatorChainTest extends TestCase {

  /**
   * @return StringLengthValidator
   */
  public function testRangeValidation() {
    $validator = new ValidatorChain();
    $this->assertCount(0, $validator);
    return $validator;
  }

}
