<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\Canvas;

/**
 * Class CanvasTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CanvasTest extends TestCase {

  use \Sphp\Tests\Html\Media\SizeableMediaTestTrait;

  public function testConstructor(): Canvas {
    $canvas = new Canvas();
    $this->assertSame('canvas', $canvas->getTagName());
    return $canvas;
  }

}
