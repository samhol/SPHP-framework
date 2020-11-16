<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests;

use ArrayAccess;
use PHPUnit\Framework\Assert;

/**
 * Trait providing ArrayAccess tests
 * 
 * ArrayAccess provides accessing objects as arrays.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait ArrayAccessTestTrait {

  abstract public function createArrayAccessObject(): ArrayAccess;

  abstract public function arrayAccessTestData(): array;

  public function testArrayAccess(): void {
    $data = $this->arrayAccessTestData();
    $container = $this->createArrayAccessObject();
    foreach ($data as $key => $value) {
      Assert::assertFalse(isset($container[$key]));
      $container[$key] = $value;
      Assert::assertTrue(isset($container[$key]));
      Assert::assertSame($value, $container[$key]);
    }
    foreach ($data as $key => $value) {
      Assert::assertTrue(isset($container[$key]));
      Assert::assertSame($value, $container[$key]);
      unset($container[$key]);
      Assert::assertFalse(isset($container[$key]));
      Assert::assertNull($container[$key]);
    }
  }

  public function testAppendUsingArrayAccess(): void {
    $data = $this->arrayAccessTestData();
    $container = $this->createArrayAccessObject();
    $index = 0;
    foreach ($data as $value) {
      Assert::assertFalse(isset($container[$index]));
      $container[] = $value;
      Assert::assertTrue(isset($container[$index]));
      Assert::assertSame($value, $container[$index]);
      $index++;
    }
    while ($index > 0) {
      $index--;
      Assert::assertTrue(isset($container[$index]));
      unset($container[$index]);
      Assert::assertFalse(isset($container[$index]));
      Assert::assertNull($container[$index]);
    }
    Assert::assertSame(0, $index);
  }

}
