<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\Url;

class UrlTest extends ValidatorTestCase {

  public function testConstructor(): void {
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->getMessages());
  }

  /**
   */
  public function testInvalidValueType(): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid('foo'));
    $errors = $validator->getMessages()->toArray();
    $this->assertContains('URL is invalid', $errors);
  }

  public function createValidator(): Url {
    return new Url('URL is invalid');
  }

  public function invalidValuesProvider(): iterable {
    yield ['a@'];
    yield [new \stdClass()];
  }

  public function validValuesProvider(): iterable {
    yield ['https://www.google.com'];
  }

}
