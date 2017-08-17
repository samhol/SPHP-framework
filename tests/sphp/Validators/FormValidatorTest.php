<?php

namespace Sphp\Validators;

class FormValidatorTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var FormValidator 
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->validator = (new FormValidator())
            ->set('num', new PatternValidator("/^\d+$/", 'Please insert numbers only'))
            ->set('p1', new PatternValidator("/^[a-zA-Z]+$/", 'Please insert alphabets only'))
            ->set('p2', new PatternValidator("/^([a-zA-Z]){3}+$/", 'Please insert exactly 3 alphabets'));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->validator);
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
   * 
   * @dataProvider invalidInputTypeData
   * @param mixed $value
   */
  public function testInvalidInputType($value) {
    $this->assertFalse($this->validator->isValid($value));
    $this->AssertCount(0, $this->validator->getInputErrors());
    $this->AssertCount(1, $this->validator->getErrors());
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
    $this->AssertCount(0, $this->validator->getInputErrors());
  }

}
