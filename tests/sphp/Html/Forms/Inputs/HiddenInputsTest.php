<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\HiddenInputs;

class HiddenInputsTest extends TestCase {

  public function arrayData(): array {
    $arr['foo'] = 'bar';
    return $arr;
  }

  public function createCollection(): \ArrayAccess {
    return new HiddenInputs();
  }

}
