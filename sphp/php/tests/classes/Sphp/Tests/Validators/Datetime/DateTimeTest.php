<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators\Datetime;

use Sphp\Tests\Validators\ValidatorTestCase;
use Sphp\Validators\Datetime\DatetimeFormat;
use Sphp\Validators\Validator;

class DateTimeTest extends ValidatorTestCase {

  protected DatetimeFormat $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->validator = $this->createValidator();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->validator);
  }

  public function testConstructor(): void {
    $this->assertCount(0, $this->validator->getErrors());
  }

  public function testValidValue(): void {
    $this->assertTrue($this->validator->isValid('2018-3-2 12:03:12'));
    $this->assertCount(0, $this->validator->getErrors());
  }

  public function testInvalidValue(): void {
    $this->assertFalse($this->validator->isValid([]));
    $errors = $this->validator->getErrors()->toArray();
    $this->assertContains('Please insert correct date and time', $errors);
  }

  public function createValidator(): Validator {
    return new DatetimeFormat();
  }

  public function getInvalidValue() {
    return 'foo';
  }

  public function getValidValue() {
    return '2018-3-2 12:03:12';
  }

}
