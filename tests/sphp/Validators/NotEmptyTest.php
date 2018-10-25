<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\NotEmpty;
use Sphp\Validators\Validator;

class NotEmptyTest extends ValidatorTest {

  /**
   * @var NotEmpty
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->validator = new NotEmpty();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
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
    $this->assertTrue($this->validator->isValid([0 => 'foo']));
    $this->assertCount(0, $this->validator->errors());
    $this->assertTrue($this->validator->isValid(['0' => 'foo']));
    $this->assertTrue($this->validator->isValid(['a' => 'foo']));
    $this->assertCount(0, $this->validator->errors());
  }

  /**
   */
  public function testInvalidValue() {
    $this->assertFalse($this->validator->isValid([]));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('Value is empty', $errors);
  }


  public function createValidator(): Validator {
    return new NotEmpty();
  }

  public function getInvalidValue() {
    return [];
  }

  public function getValidValue() {
    return [1];
  }

}
