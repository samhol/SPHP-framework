<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators\Datetime;

use Sphp\Tests\Validators\ValidatorTest;
use Sphp\Validators\Validator;

/**
 * Implementation of AbstractDateTimeValidatorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractDateTimeValidatorTest extends ValidatorTest {

  /**
   * @var LaterThan
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

  public function invalidTypes(): array {
    $data[] = ['not a day'];
    $data[] = ['foo'];
    $data[] = [new \stdClass];
    $data[] = [[]];
    return $data;
  }

  /**
   * @dataProvider invalidTypes
   * 
   * @param mixed $value
   */
  public function testInvalidTypes($value) {
    $this->assertFalse($this->validator->isValid($value));
    $this->assertCount(1, $this->validator->errors());
    $this->assertSame($this->validator->errors()->getTemplate(Validator::INVALID), $this->validator->errors()->current());
  }

  public function testInclusive() {
    $date = new \Sphp\DateTime\DateTime('2001-4-4');
    $v = $this->createValidator($date);
    $v->setInclusive(false);
    //print_r($v->errorsToArray());
    $this->assertFalse($v->isValid($date));
    //print_r($v->errorsToArray());
    $v->setInclusive(true);
    $this->assertTrue($v->isValid($date));
  }

}
