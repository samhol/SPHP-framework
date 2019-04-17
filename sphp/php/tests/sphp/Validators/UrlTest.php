<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\Url;
use Sphp\Validators\Validator;

class UrlTest extends ValidatorTest {

  /**
   * @var Url
   */
  protected $validator;

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

  /**
   */
  public function testConstructor() {
    $this->assertCount(0, $this->validator->errors());
  }

  /**
   */
  public function testValidValue() {
    $this->assertTrue($this->validator->isValid('http://www.google.com'));
    $this->assertCount(0, $this->validator->errors());
  }

  /**
   */
  public function testInvalidValue() {
    $this->assertFalse($this->validator->isValid([]));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('URL is invalid', $errors);
  }


  public function createValidator(): Validator {
    return new Url('URL is invalid');
  }

  public function getInvalidValue() {
    return 'a@';
  }

  public function getValidValue() {
    return 'http://www.google.com';
  }

}
