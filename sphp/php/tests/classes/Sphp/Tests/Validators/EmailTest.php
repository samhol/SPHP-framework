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

use Sphp\Validators\Email;

/**
 * Email validation testing
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class EmailTest extends ValidatorTestCase {

  public function testWithSkip() {
    $validator = $this->createValidator();
    $this->assertTrue($validator->isValid('sami.holck@gmail.com'));
    $validator->getValue();
    $this->assertCount(0, $validator->getMessages());
    $this->assertFalse($validator->isValid('foo'));
    $this->assertCount(1, $validator->getMessages());
    $this->assertContains('Email foo fails badly', $validator->getMessages());
  }

  public function createValidator(): Email {
    return new Email('Email :value fails badly');
  }

  public function invalidValuesProvider(): iterable {
    yield ['foo.fi'];
    yield [null];
  }

  public function validValuesProvider(): iterable {
    yield ['sami.holck@gmail.com'];
  }

}
