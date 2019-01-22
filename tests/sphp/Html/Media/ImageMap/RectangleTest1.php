<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;

class RectangleTest1 extends TestCase {

  public function testConstructor(): Rectangle {
    $rect = new Rectangle(1, 1, 10, 10, 'default', 'foo/bar', 'Foo Bar');
    $this->assertEquals('1,1,10,10', $rect->getCoordinates()->getValue());
    return $rect;
  }

}
