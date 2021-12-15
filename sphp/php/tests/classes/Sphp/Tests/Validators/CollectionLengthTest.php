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

use PHPUnit\Framework\TestCase;
use IteratorAggregate;
use Sphp\Validators\CollectionLength;

class CollectionLengthTest extends TestCase {

  protected CollectionLength $validator;

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
    $expected = vsprintf($this->validator->getErrors()->getTemplate(CollectionLength::SMALLER_ERROR), 3);
    $errors = $this->validator->getErrors()->toArray();
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
   * 
   * @param  mixed $data
   * @return void
   */
  public function testTooLarge($data): void {
    $this->validator->setMin(1)->setMax(4);
    $this->assertFalse($this->validator->isValid($data));
    $expected = vsprintf($this->validator->getErrors()->getTemplate(CollectionLength::LARGER_ERROR), 4);
    $errors = $this->validator->getErrors()->toArray();
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
   *  
   * @param  mixed $data
   * @return void
   */
  public function testInvalidType($data): void {
    $this->assertFalse($this->validator->isValid($data));
    $expected = $this->validator->getErrors()->getTemplate(CollectionLength::INVALID);
    $errors = $this->validator->getErrors()->toArray();
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
