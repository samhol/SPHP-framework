<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Validators\JsonString;

/**
 * Class JsonStringTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class JsonStringTest extends TestCase {

  public function testConstructor() {
    $validator = new JsonString;
    $this->assertCount(0, $validator->getErrors());
  }

  public function validData(): array {
    $data = [];
    $data[] = ['{"foo": 1}'];
    $data[] = ['{"foo": "bar"}'];
    return $data;
  }

  /**
   * @dataProvider validData
   * @param string $value
   */
  public function testValidValues(string $value) {
    $validator = new JsonString;
    $this->assertTrue($validator->isValid($value));
    $this->assertSame($value, $validator->getValue());
  }

  public function invalidData(): array {
    $data = [];
    $data[] = ['{"foo": bar}'];
    $data[] = ['{"foo": "bar"'];
    $data[] = ['foo'];
    $data[] = [''];
    return $data;
  }

  /**
   * @dataProvider invalidData
   * 
   * @param  string $value
   * @param  string $value
   * @return void
   */
  public function testInvalidValues(string $value): void {
    $validator = new JsonString;
    $this->assertFalse($validator->isValid($value));
    $this->assertSame($value, $validator->getValue());
  }

  public function nonStringsData(): array {
    $data = [];
    $data[] = [1];
    $data[] = [.5];
    $data[] = [new \stdClass()];
    $data[] = [null];
    $data[] = [true];
    $data[] = [false];
    return $data;
  }

  /**
   * @dataProvider nonStringsData
   * 
   * @param  mixed $value
   * @return void
   */
  public function testNonStrings($value): void {
    $validator = new JsonString;
    $this->assertFalse($validator->isValid($value));
    $this->assertSame($value, $validator->getValue());
  }

}
