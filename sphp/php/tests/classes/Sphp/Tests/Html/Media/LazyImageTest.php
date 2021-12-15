<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\LazyImage;

/**
 * Class LazyImageTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazyImageTest extends TestCase {

  public function testProperties() {
    $img = new LazyImage('src.png', 'alt text');
    $this->assertSame('src.png', $img->getAttribute('data-src'));
    $this->assertSame('src.png', $img->getSrc());
    $this->assertSame('<img ' . $img->attributes() . '>', $img->getHtml());
  }

}
