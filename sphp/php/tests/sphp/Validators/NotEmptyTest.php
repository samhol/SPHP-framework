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
  protected function setUp(): void {
    $this->validator = new NotEmpty();
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

  public function mockCountable(int $count): \Countable {
    $stub = $this->getMockBuilder(\Countable::class)->getMock();
    $stub->method('count')
            ->will($this->returnValue($count));
    return $stub;
  }

  public function emptyValues(): array {
    $values = [];
    $values[] = [[], NotEmpty::ANY_TYPE];
    $values[] = ['', NotEmpty::ANY_TYPE];
    $values[] = [new \ArrayIterator(), NotEmpty::ANY_TYPE];
    $values[] = [$this->mockCountable(0), NotEmpty::ANY_TYPE];
    $values[] = [null, NotEmpty::ANY_TYPE];
    $values[] = [[], NotEmpty::ARRAY_TYPE];
    $values[] = [null, NotEmpty::ARRAY_TYPE];
    $values[] = [null, NotEmpty::STRING_TYPE];
    $values[] = ['', NotEmpty::STRING_TYPE];
    $values[] = [new \ArrayIterator(), NotEmpty::TRAVERSABLE_TYPE];
    $values[] = [$this->mockCountable(0), NotEmpty::COUNTABLE_TYPE];
    $values[] = ['', NotEmpty::STRING_TYPE];
    return $values;
  }

  /**
   * @dataProvider emptyValues
   *
   * @param mixed $value
   * @param int $type
   */
  public function testEmptyValues($value, int $type) {
    $validator = new NotEmpty($type);
    $this->assertFalse($validator->isValid($value), 'Value is not recognized as empty');
    $errors = $validator->errors()->toArray();
    $this->assertContains('Value is empty', $errors);
  }

  public function nonEmptyValues(): array {
    $values = [];
    $values[] = [[1], NotEmpty::ANY_TYPE];
    $values[] = [' ', NotEmpty::ANY_TYPE];
    $values[] = [new \ArrayIterator([1]), NotEmpty::ANY_TYPE];
    $values[] = [$this->mockCountable(1), NotEmpty::ANY_TYPE];
    $values[] = [[1], NotEmpty::ARRAY_TYPE];
    $values[] = [' ', NotEmpty::STRING_TYPE];
    $values[] = [new \ArrayIterator([1]), NotEmpty::TRAVERSABLE_TYPE];
    $values[] = [$this->mockCountable(1), NotEmpty::COUNTABLE_TYPE];
    return $values;
  }

  /**
   * @dataProvider nonEmptyValues
   *
   * @param mixed $value
   * @param int $type
   */
  public function testNonEmptyValues($value, int $type) {
    $validator = new NotEmpty($type);
    $this->assertTrue($validator->isValid($value), 'Value is recognized as empty');
    $errors = $validator->errors()->toArray();
    $this->assertCount(0, $errors);
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
