<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\CommonMark;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\CommonMark\ApiLink;
use Sphp\Documentation\Linkers\ItemLinker;
use Sphp\Documentation\Linkers\PHP\ClassLinker;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;

/**
 * Class ApiLinkTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ApiLinkTest extends TestCase {

  protected PHPApiUrlGeneratorCollection $ulrs;

  protected function setUp(): void {
    $this->ulrs = new PHPApiUrlGeneratorCollection();
  }

  public function linkers(): iterable {
    yield [ ClassLinker::create(\ReflectionClass::class, new PHPApiUrlGeneratorCollection())];
  }

  /**
   * @dataProvider linkers
   * 
   * @param  ItemLinker $itemLinker
   * @return void
   */
  public function testConstructors(ItemLinker $itemLinker): void {
    $aoiLink = new ApiLink($itemLinker);
    $this->assertSame($itemLinker, $aoiLink->getLinker());
    $this->assertSame($itemLinker->getUrl(), $aoiLink->getUrl());
  }

}
