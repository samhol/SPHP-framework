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

use Sphp\Validators\MapValidator;
use Sphp\Validators\Regex;

class MapValidatorTest extends ValidatorTestCase {

  public function createValidator(): MapValidator {
    return (new MapValidator())
                    ->setValidator('num', new Regex("/^\d+$/", 'Please insert numbers only'))
                    ->setValidator('p1', new Regex("/^[a-zA-Z]+$/", 'Please insert alphabets only'))
                    ->setValidator('p2', new Regex("/^([a-zA-Z]){3}$/", 'Please insert exactly 3 alphabets'));
  }

  public function invalidValueTypeProvider(): iterable {
    yield [null];
    yield [false];
    yield [true];
    yield [0];
    yield ['foo'];
  }

  /**
   * @dataProvider invalidValueTypeProvider
   *
   * @param  mixed $value
   * @return void
   */
  public function testInvalidInputType(mixed $value): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid($value));
    $this->assertCount(1, $validator->getMessages());
    $template = $validator->getMessages()->getTemplate(MapValidator::NOT_MAP_DATA);
    $this->assertSame(
            'Value of ' . gettype($value) . ' type given. An array expected',
            $validator->getMessages()->getFirstMessage());
  }

  public function invalidValuesProvider(): iterable {
    $data[] = [
        [
            'num' => 'a',
            'p1' => '1',
            'p2' => 'aaaa'
        ]
    ];
    return $data;
  }

  /**
   *
   * @dataProvider invalidValuesProvider
   * @param array $value
   */
  public function testInvalidValues(array $value) {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid($value));
  }

  public function validValuesProvider(): iterable {
    $data[] = [
        [
            'num' => '123',
            'p1' => 'abcde',
            'p2' => 'xyz'
        ]
    ];
    return $data;
  }

  /**
   *
   * @dataProvider validValuesProvider
   * @param array $value
   */
  public function testValidValues(array $value) {
    $validator = $this->createValidator();
    $this->assertTrue($validator->isValid($value));
    $this->assertCount(0, $validator->getMessages());
  }

  public function testValidatorManagement() {
    $validator = $this->createValidator();
    $regex = new Regex("/^[foo]$/", 'foo is foo');
    $this->assertSame($validator, $validator->setValidator('foo', $regex));
    $this->assertTrue($validator->hasValidator('foo'));
    $this->assertSame($regex, $validator->getValidator('foo'));
    $this->assertNull($validator->getValidator('bar'));
  }

  public function testGetInputErrors() {

    $regex1 = new Regex("/^[foo]$/", 'foo is not here');
    $regex2 = new Regex("/^[bar]$/", 'bar is not here');
    $validator = new MapValidator();
    $validator->setValidator('foo-field', $regex1);
    $validator->setValidator('bar-field', $regex2);
    $this->assertFalse($validator->isValid('foo'));
    $this->assertCount(1, $validator->getMessages());
    $this->assertEmpty($validator->getMapMessages());
    $this->assertFalse($validator->isValid(['foo-field' => 'foo']));
  }

}
