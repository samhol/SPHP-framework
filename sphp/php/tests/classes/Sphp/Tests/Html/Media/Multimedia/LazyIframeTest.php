<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\LazyIframe;

/**
 * Class IframeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazyIframeTest extends TestCase {

  /**
   * @return LazyIframe
   */
  public function testConstructor(): LazyIframe {
    $src = 'https://foo.com';
    $iframe = new LazyIframe($src);
    $this->assertSame($src, $iframe->getSrc());
    $this->assertSame($src, $iframe->getAttribute('data-src'));
    return $iframe;
  }

  /**
   * @depends testConstructor
   * @return void
   */
  public function testSetAndGetSrc(LazyIframe $iframe): void {
    $src = 'bar.php';
    $this->assertSame($iframe, $iframe->setSrc($src));
    $this->assertSame($src, $iframe->getSrc());
    $this->assertSame($src, $iframe->getAttribute('data-src'));
  }

}
