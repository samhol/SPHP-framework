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

use Sphp\Validators\IsInstanceOf; 
use Sphp\Exceptions\InvalidArgumentException;

class IsInstanceOfTest extends ValidatorTestCase {

  /**
   * @var IsInstanceOf
   */
  protected IsInstanceOf $validator;

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
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->getMessages());
    $this->assertEquals(\Iterator::class, $validator->getClassName());
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
    $this->assertCount(0, $this->validator->getMessages());
  }

  /**
   */
  public function testInvalidValue() {
    $this->assertFalse($this->validator->isValid(new \ArrayIterator()));
    $errors = $this->validator->getMessages()->toArray();
    $this->assertContains('Value is not instance of stdClass', $errors);
  }

  public function createValidator(): IsInstanceOf {
    return new IsInstanceOf(\Iterator::class);
  }

  public function invalidValuesProvider(): iterable {
    yield [new \stdClass()];
    yield ['foo'];
    yield [null];
  }

  public function validValuesProvider(): iterable {
    yield [new \ArrayIterator()];
    yield [new \RecursiveArrayIterator()];
  }

}
