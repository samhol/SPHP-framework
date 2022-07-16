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

  public function createValidator($limit = 'now', bool $inclusive = true): LaterThan {
    return new LaterThan($limit, $inclusive);
  }

  public function invalidValuesProvider(): iterable {
    yield ['last monday'];
  }

  public function validValuesProvider(): iterable {
   yield ['next monday'];
  }

  public function invalidTypes(): iterable {
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
  public function testInvalidTypes($value): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid($value));
    $this->assertCount(1, $validator->getMessages());
  }

  public function testInclusive(): void {
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
