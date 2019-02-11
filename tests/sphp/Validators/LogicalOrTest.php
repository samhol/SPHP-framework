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

/**
 * Description of LogicalOrTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LogicalOrTest extends TestCase {

  /**
   * @var LogicalOr
   */
  protected $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $patt = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $group = new InHaystack([null]);
    $this->validator = new LogicalOr($group, $patt);
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
  public function testClone() {
    $a = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $b = new InHaystack([null]);
    $validator = new LogicalOr($a, $b);
    $clone = clone $validator;
    $this->assertNotSame($validator, $clone);
  }

  /**
   */
  public function testValidValue() {
    $this->assertTrue($this->validator->isValid(null));
    $this->assertCount(0, $this->validator->errors());
    $this->assertTrue($this->validator->isValid('foo'));
    $this->assertCount(0, $this->validator->errors());
  }

  /**
   */
  public function testInvalidValue() {
    $v = $this->validator;
    $this->assertFalse($v(1));
    $this->assertFalse($this->validator->isValid(1));
    $errors = $this->validator->errors()->toArray();
    $this->assertContains('Please insert alphabets only', $errors);
  }

}
