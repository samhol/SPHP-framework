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
use Sphp\Validators\Datetime\EarlierThan;

/**
 * Implementation of EarlierThanTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class EarlierThanTest extends ValidatorTestCase {

  protected EarlierThan $validator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->validator = $this->createValidator();
  }

  public function createValidator($limit = 'now', bool $inclusive = true): Validator {
    return new EarlierThan($limit, $inclusive);
  }

  public function getInvalidValue() {
    return 'next monday';
  }

  public function getValidValue() {
    return 'last monday';
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
  public function testInvalidTypes($value): void {
    $this->assertFalse($this->validator->isValid($value));
    $this->assertCount(1, $this->validator->getErrors());
  }

  public function testInclusive(): void {
    $date = ImmutableDateTime::from('2001-4-4');
    $v = $this->createValidator($date);
    $v->setInclusive(false);
    $this->assertFalse($v->isValid($date));
    $v->setInclusive(true);
    $this->assertTrue($v->isValid($date));
  }

}
