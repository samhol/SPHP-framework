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
use Sphp\Apps\PoSearch\Data\EntryFileFilter;
use Sphp\Apps\PoSearch\Data\PoFile;
use SplFileInfo;

/**
 * Class EntryFileFilterTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EntryFileFilterTest extends TestCase {

  /**
   * @return void
   */
  public function testFilter(): void {
    $filter = new EntryFileFilter(new PoFile(new SplFileInfo('./sphp/php/tests/files/mixed.po')));
    $this->assertCount(2, $filter);
    $this->assertCount(1, $filter->searchPlurals(false));
    $this->assertCount(1, $filter->searchSingulars(false)->searchPlurals(true));
    $this->assertCount(0, $filter->searchSingulars(false)->searchPlurals(false));
    $this->assertCount(2, $filter->searchSingulars(true)->searchPlurals(true)->searchIDsLike('foo'));
    $this->assertCount(1, $filter->searchIDsLike('foos'));
    $filter->setFlags(0);
    $this->assertCount(2, $filter->searchIDsLike(null));
  }

}
