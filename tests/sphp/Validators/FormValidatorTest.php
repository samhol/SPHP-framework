<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\FormValidator;
use Sphp\Validators\Regex;
use Sphp\Validators\Validator;

class FormValidatorTest extends ValidatorTest {

  /**
   * @var FormValidator 
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

  public function createValidator(): Validator {
    return (new FormValidator())
                    ->setValidator('num', new Regex("/^\d+$/", 'Please insert numbers only'))
                    ->setValidator('p1', new Regex("/^[a-zA-Z]+$/", 'Please insert alphabets only'))
                    ->setValidator('p2', new Regex("/^([a-zA-Z]){3}+$/", 'Please insert exactly 3 alphabets'));
  }

  public function getInvalidValue() {
    return [
        'num' => 'a',
        'p1' => '1',
        'p2' => 'aaaa'
    ];
  }

  public function getValidValue() {
    return [
        'num' => '123',
        'p1' => 'abcde',
        'p2' => 'xyz'
    ];
  }

  /**
   * 
   * @return array
   */
  public function invalidInputTypeData() {
    $data[] = [null];
    $data[] = [false];
    $data[] = [true];
    $data[] = [0];
    $data[] = ['foo'];
    return $data;
  }

  /**
   * @dataProvider invalidInputTypeData
   * @param mixed $value
   */
  public function testInvalidInputType($value) {
    $this->assertFalse($this->validator->isValid($value));
  }

  public function invalidData() {
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
   * @dataProvider invalidData
   * @param array $value
   */
  public function testInvalidValues(array $value) {
    $this->assertFalse($this->validator->isValid($value));
  }

  public function validData() {
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
   * @dataProvider validData
   * @param array $value
   */
  public function testValidValues(array $value) {
    $this->assertTrue($this->validator->isValid($value));
    $this->AssertCount(0, $this->validator->errors());
  }

  public function testValidatorManagement() {
    $regex = new Regex("/^[foo]$/", 'foo is foo');
    $this->assertSame($this->validator, $this->validator->setValidator('foo', $regex));
    $this->assertTrue($this->validator->hasValidator('foo'));
    $this->assertSame($regex, $this->validator->getValidator('foo'));
    $this->expectException(\Sphp\Exceptions\OutOfBoundsException::class);
    $this->assertSame($regex, $this->validator->getValidator('bar'));
  }

}
