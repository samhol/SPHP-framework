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

class CollectionLengthTest extends TestCase {
  
  /**
   */
  public function testUpperBoundValidation() {
    $validator = new CollectionLengthValidator(null, 5);
    $this->assertSame($validator, $validator->setUpperBoundValidation(5));
    $this->assertTrue($validator->isUpperBoundValidator());
    $this->assertFalse($validator->isLowerBoundValidator());
    $this->assertFalse($validator->isRangeValidator());
    $this->assertTrue($validator->isValid(''));
    $this->assertFalse($validator->isValid('foobar'));
    $validator->setUpperBoundValidation(-1);
  }
}
