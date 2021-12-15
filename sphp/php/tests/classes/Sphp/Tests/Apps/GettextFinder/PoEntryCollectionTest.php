<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\GettextFinder;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\PoSearch\Data\PoEntryCollection;

/**
 * Class PoEntryCollectionTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PoEntryCollectionTest extends TestCase {

  public function validFiles(): array {
    $paths = glob('./sphp/locale/*/*/*.po');
    $out = [];
    foreach ($paths as $path) {
      $out[] = [$path];
    }
    return $out;
  }

  public function testConstructor(): PoEntryCollection {
    $coll = PoEntryCollection::fromFile('./sphp/php/tests/files/test.po');
    $this->assertCount(20, $coll);
    return $coll;
  }

  /**
   * @depends testConstructor
   * 
   * @param PoEntryCollection $coll
   * @return void
   */
  public function testGettingData(PoEntryCollection $coll): void {
    $this->assertCount(20, $coll->toArray()); 
    $this->assertCount(20, $coll);
  }

  /**
   * @depends testConstructor
   * 
   * @param PoEntryCollection $coll
   * @return void
   */
  public function testTraversing(PoEntryCollection $coll) {
    $arr = $coll->toArray();
    foreach ($coll as $k => $e) {
      $this->assertSame($arr[$k], $e);
    }
  }

}
