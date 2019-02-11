<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\IsInstanceOf;
use Sphp\Validators\Validator;
use Sphp\Exceptions\InvalidArgumentException;

class IsInstanceOfTest extends ValidatorTest {

  /**
   * @var IsInstanceOf
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->validator = new IsInstanceOf(\stdClass::class);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->validator);
  }

  public function testConstructor() {
    $this->assertCount(0, $this->validator->errors());
    $this->assertEquals(\stdClass::class, $this->validator->getClassName());
  }

  public function testChangeWhitelist() {
    $this->validator->setClassName(\ArrayAccess::class);
    $this->assertEquals(\ArrayAccess::class, $this->validator->getClassName());
    $this->assertTrue($this->validator->isValid(new \ArrayIterator()));
    $this->expectException(InvalidArgumentException::class);
    $this->validator->setClassName('foo');
  }

  /**
   */
  public function testValidValue() {
    $this->assertTrue($this->validator->isValid(new \stdClass()));
    $this->assertCount(0, $this->validator->errors());
  }

  /**
   */
  public function testInvalidValue() {
    $this->assertFalse($this->validator->isValid(new \ArrayIterator()));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('Value is not instance of stdClass', $errors);
  }

  public function createValidator(): Validator {
    return new IsInstanceOf(\stdClass::class);
  }

  public function getInvalidValue() {
    return new \ArrayIterator();
  }

  public function getValidValue() {
    return new \stdClass();
  }

}
