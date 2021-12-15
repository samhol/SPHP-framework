<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators\Datetime;

use Sphp\Tests\Validators\ValidatorTestCase;
use Sphp\Validators\Validator;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\Validators\Datetime\LaterThan;

/**
 * Implementation of LaterThanTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LaterThanTest extends ValidatorTestCase {

  protected LaterThan $validator;

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

  public function createValidator($limit = 'now', bool $inclusive = true): Validator {
    return new LaterThan($limit, $inclusive);
  }

  public function getInvalidValue() {
    return 'last monday';
  }

  public function getValidValue() {
    return 'next monday';
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
  public function testInvalidTypes($value):void {
    $this->assertFalse($this->validator->isValid($value));
    $this->assertCount(1, $this->validator->getErrors()); 
  }

  public function testInclusive():void {
    $date = ImmutableDateTime::from('2001-4-4');
    $v = $this->createValidator($date);
    $v->setInclusive(false);
    //print_r($v->errorsToArray());
    $this->assertFalse($v->isValid($date));
    //print_r($v->errorsToArray());
    $v->setInclusive(true);
    $this->assertTrue($v->isValid($date));
  }

}
