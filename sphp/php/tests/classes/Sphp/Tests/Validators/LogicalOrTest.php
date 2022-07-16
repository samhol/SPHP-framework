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
class LogicalOrTest extends ValidatorTestCase {

  public function testClone(): void {
    $validator = $this->createValidator();
    $clone = clone $validator;
    $this->assertNotSame($validator, $clone);
  }

  public function createValidator(): LogicalOr {
    $patt = new Regex('/^[a-zA-Z]+$/', 'Please insert alphabets only');
    $group = new InHaystack([null, 3]);
    return new LogicalOr($group, $patt);
  }

  public function invalidValuesProvider(): iterable {
    yield [2];
    yield ['a2'];
    yield [new \stdClass()];
  }

  public function validValuesProvider(): iterable {
    yield ['a'];
    yield [null];
    yield [3];
  }

}
