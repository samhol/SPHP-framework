<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Foundation\Sites\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\Iframe;
class ResponsiveEmbedTest extends TestCase {

  public function testConstruction() {
    $iframeEmbed = ResponsiveEmbed::iframe('foo/bar');
    $this->assertInstanceOf(Iframe::class, $iframeEmbed->getEmbeddable());
  }

}
