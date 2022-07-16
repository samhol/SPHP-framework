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

/**
 * Implementation of AbstractDateTimeValidatorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractDateTimeValidatorTest extends ValidatorTestCase {

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
    $this->assertCount(1, $this->validator->getMessages());
    $this->assertSame($this->validator->getMessages()->getTemplate(Validator::INVALID), $this->validator->getMessages()->current());
  }

  public function testInclusive() {
    $date = new ImmutableDateTime('2001-4-4');
    $v = $this->createValidator($date);
    $v->setInclusive(false);
    //print_r($v->errorsToArray());
    $this->assertFalse($v->isValid($date));
    //print_r($v->errorsToArray());
    $v->setInclusive(true);
    $this->assertTrue($v->isValid($date));
  }

}
