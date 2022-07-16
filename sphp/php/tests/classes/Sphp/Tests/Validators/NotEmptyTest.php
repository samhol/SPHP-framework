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

use Sphp\Validators\NotEmpty;

class NotEmptyTest extends ValidatorTestCase {

  public function testConstructor(): void {
    $validator = new NotEmpty();
    $this->assertCount(0, $validator->getMessages());
  }

  /**
   * @dataProvider validValuesProvider
   * 
   * @param  mixed $value
   * @return void
   */
  public function testValidValue(mixed $value): void {
    $validator = new NotEmpty();
    $this->assertTrue($validator->isValid($value));
    $this->assertCount(0, $validator->getMessages());
    $this->assertNull($validator->getMessages()->getFirstMessage());
  }

  /**
   * @dataProvider invalidValuesProvider
   * 
   * @param  mixed $value
   * @return void
   */
  public function testInvalidValue(mixed $value): void {
    $validator = new NotEmpty();
    $this->assertFalse($validator->isValid($value), 'Value is not recognized as empty');
    $this->assertContains('Value is empty', $validator->getMessages());
  }

  public function mockCountable(int $count): \Countable {
    $stub = $this->getMockBuilder(\Countable::class)->getMock();
    $stub->method('count')
            ->will($this->returnValue($count));
    return $stub;
  }

  public function createValidator(): NotEmpty {
    return new NotEmpty();
  }

  public function invalidValuesProvider(): iterable {
    yield [null];
    yield [''];
    yield ["\t\n "];
    yield [[]];
    yield [new \ArrayIterator()];
    yield [$this->mockCountable(0)];
  }

  public function validValuesProvider(): iterable {
    yield [new \stdClass()];
    yield ['foo'];
    yield [new \ArrayIterator([1, 2])];
    yield [$this->mockCountable(1)];
    yield [['foo']];
    yield [new \Sphp\Html\Text\Hr()];
  }

}
