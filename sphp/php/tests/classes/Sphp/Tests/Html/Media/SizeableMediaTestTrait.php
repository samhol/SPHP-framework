<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media;

use Sphp\Html\Media\SizeableMedia;
use PHPUnit\Framework\Assert;

/**
 * Trait SizeableMediaTestTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait SizeableMediaTestTrait {

  abstract public function testConstructor(): SizeableMedia;

  /**
   * @depends testConstructor
   * 
   * @param  SizeableMedia $media
   * @return void
   */
  public function testSetSize(SizeableMedia $media): void {
    Assert::assertSame(null, $media->attributes()->getValue('width'));
    Assert::assertSame(null, $media->attributes()->getValue('height'));
    Assert::assertSame($media, $media->setSize(100, 200));
    Assert::assertSame(100, $media->attributes()->getValue('width'));
    Assert::assertSame(200, $media->attributes()->getValue('height'));
    Assert::assertSame($media, $media->setSize(100, null));
    Assert::assertSame(100, $media->attributes()->getValue('width'));
    Assert::assertSame(null, $media->attributes()->getValue('height'));
    Assert::assertSame($media, $media->setSize(null, 200));
    Assert::assertSame(null, $media->attributes()->getValue('width'));
    Assert::assertSame(200, $media->attributes()->getValue('height'));
  }

}
