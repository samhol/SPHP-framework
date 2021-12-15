<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Datastructures;

use Sphp\Stdlib\Datastructures\Stack;
use Sphp\Stdlib\Datastructures\ArrayStack;

/**
 * Implementation of ArrayStackTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ArrayStackTest extends StackTest {

  /**
   * @return Stack
   */
  public function createStack(): Stack {
    return new ArrayStack();
  }

  /**
   * @dataProvider stackingData
   */
  public function testToArray(array $data): void {
    $stack = new ArrayStack($data);
    $this->assertSame($data, $stack->toArray());
  }

}
