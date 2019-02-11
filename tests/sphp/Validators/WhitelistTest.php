<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\Whitelist;
use Sphp\Validators\Validator;

class WhitelistTest extends ValidatorTest {

  /**
   * @var Whitelist
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->validator = new Whitelist(['a', '0', 0], 'An illegal key found');
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
    $this->assertEquals(['a', '0', 0], $this->validator->getWhitelist());
  }

  /**
   */
  public function testChangeWhitelist() {
    $this->validator->setWhitelist([1, 2]);
    $this->assertEquals([1, 2], $this->validator->getWhitelist());
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
    $this->assertFalse($this->validator->isValid([1 => 'foo']));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('An illegal key found', $errors);
  }

  /**
   */
  public function testNotArray() {
    $this->assertFalse($this->validator->isValid(1));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('Array expected', $errors);
  }

  public function createValidator(): Validator {
    return new Whitelist(['a', 'b'], 'An illegal key found');
  }

  public function getInvalidValue() {
    return [range(1, 3)];
  }

  public function getValidValue() {
    return ['a' => 'a', 'b' => 'b'];
  }

}
