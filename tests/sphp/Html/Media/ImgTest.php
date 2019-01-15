<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use PHPUnit\Framework\TestCase;

class ImgTest extends TestCase {

  /**
   * @return Img
   */
  public function testConstructor(): Img {
    $empty = new Img();
    $this->assertSame('', $empty->getSrc());
    $this->assertSame('', $empty->getAlt());
    $img = new Img('foo/bar', 'foo bar');
    $this->assertSame('foo/bar', $img->getSrc());
    $this->assertSame('foo bar', $img->getAlt());
    return $img;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Img $img
   * @return Img
   */
  public function testUseMap(Img $img): Img {
    $map = new ImageMap\Map('foo-map');
    $img->useMap($map);
    $this->assertSame("#{$map->getName()}", $img->attributes()->getValue('usemap'));
    return $img;
  }

}
