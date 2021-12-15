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
use Sphp\Validators\LogicalOr;
use Sphp\Validators\Regex;
use Sphp\Validators\InHaystack;

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
  public function testConstructor(): void {
    $this->assertCount(0, $this->validator->getErrors());
  }

  /**
   */
  public function testClone(): void {
    $a = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $b = new InHaystack([null]);
    $validator = new LogicalOr($a, $b);
    $clone = clone $validator;
    $this->assertNotSame($validator, $clone);
  }

  /**
   */
  public function testValidValue(): void {
    $this->assertTrue($this->validator->isValid(null));
    $this->assertCount(0, $this->validator->getErrors());
    $this->assertTrue($this->validator->isValid('foo'));
    $this->assertCount(0, $this->validator->getErrors());
  }

  /**
   */
  public function testInvalidValue(): void {
    $v = $this->validator;
    $this->assertFalse($v(1));
    $this->assertFalse($this->validator->isValid(1));
    $errors = $this->validator->getErrors()->toArray();
    $this->assertContains('Please insert alphabets only', $errors);
  }

}
