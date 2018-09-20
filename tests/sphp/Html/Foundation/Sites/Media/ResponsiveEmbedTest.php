<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media;

use PHPUnit\Framework\TestCase;

class ResponsiveEmbedTest extends TestCase {

  public function testConstruction() {
    $iframeEmbed = ResponsiveEmbed::iframe('foo/bar');
    $this->assertInstanceOf(\Sphp\Html\Media\Iframe::class, $iframeEmbed->getEmbeddable());
  }

}
