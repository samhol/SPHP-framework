<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Icons\Svg;

/**
 * Description of SvgTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SvgTest extends TestCase {

  public function testConstructor(): void {
    $svg = \Sphp\Html\Media\Icons\SvgLoader::fileToObject('./sphp/php/tests/files/human-skull.svg');
    $svg->setTitle('foo');
    $this->assertCount(1, $svg->getSvg()->getElementsByTagName('title'));
  }

}
