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
use IteratorAggregate;

class CollectionLengthTest extends TestCase {

  /**
   * @var CollectionLength
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->validator = new CollectionLength(1, 5);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->validator);
  }

  public function validData(): array {
    $data[] = [['a']];
    $data[] = [range(1, 5)];
    $data[] = [new \ArrayObject(range(1, 5))];
    $data[] = [$this->mockIteratorAggregate([1, 5])];
    $data[] = [$this->mockIteratorAggregate(['a'])];
    return $data;
  }

  /**
   * @dataProvider validData
   */
  public function testValid($data) {
    $this->assertTrue($this->validator->isValid($data));
  }

  public function tooSmall(): array {
    $data[] = [[]];
    $data[] = [[1]];
    $data[] = [new \ArrayObject()];
    $data[] = [new \ArrayObject([1])];
    $data[] = [$this->mockIteratorAggregate([1, 2])];
    return $data;
  }

  /**
   * @dataProvider tooSmall
   * @param mixed $data
   */
  public function testTooSmall($data) {
    $this->validator->setMin(3)->setMax(4);
    $this->assertFalse($this->validator->isValid($data));
    $expected = vsprintf($this->validator->errors()->getTemplate(CollectionLength::SMALLER_ERROR), 3);
    $errors = $this->validator->errors()->toArray();
    $this->assertContains($expected, $errors);
  }

  public function tooLarge(): array {
    $data[] = [range(1, 5)];
    $data[] = [new \ArrayObject(range(1, 5))];
    $data[] = [$this->mockIteratorAggregate(range(1, 5))];
    return $data;
  }

  /**
   * @dataProvider tooLarge
   * @param mixed $data
   */
  public function testTooLarge($data) {
    $this->validator->setMin(1)->setMax(4);
    $this->assertFalse($this->validator->isValid($data));
    $expected = vsprintf($this->validator->errors()->getTemplate(CollectionLength::LARGER_ERROR), 4);
    $errors = $this->validator->errors()->toArray();
    $this->assertContains($expected, $errors);
  }

  public function invalidType(): array {
    $data[] = [1];
    $data[] = ['string'];
    $data[] = [true];
    $data[] = [false];
    $data[] = [new \stdClass()];
    return $data;
  }

  /**
   * @dataProvider invalidType
   * @param mixed $data
   */
  public function testInvalidType($data) {
    $this->assertFalse($this->validator->isValid($data));
    $expected = $this->validator->errors()->getTemplate(CollectionLength::INVALID);
    $errors = $this->validator->errors()->toArray();
    $this->assertContains($expected, $errors);
  }

  /**
   * 
   * @param  array $content
   * @return IteratorAggregate
   */
  public function mockIteratorAggregate(array $content = []): IteratorAggregate {
    $mock = $this->getMockBuilder(IteratorAggregate::class)
            ->getMock();
    $mock->expects($this->any())
            ->method('getIterator')
            ->will($this->returnValue(new \ArrayIterator($content)));
    return $mock;
  }

}
