<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\Img;
use Sphp\Html\Media\Pictures\ImageMap\Map;

class ImgTest extends TestCase {

  use \Sphp\Tests\Html\Media\SizeableMediaTestTrait;

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
   * @return void
   */
  public function te2stSetSize(Img $img): void {
    $this->assertSame(null, $img->attributes()->getValue('width'));
    $this->assertSame(null, $img->attributes()->getValue('height'));
    $this->assertSame($img, $img->setSize(100, 200));
    $this->assertSame(100, $img->attributes()->getValue('width'));
    $this->assertSame(200, $img->attributes()->getValue('height'));
    $this->assertSame($img, $img->setSize(100, null));
    $this->assertSame(100, $img->attributes()->getValue('width'));
    $this->assertSame(null, $img->attributes()->getValue('height'));
    $this->assertSame($img, $img->setSize(null, 200));
    $this->assertSame(null, $img->attributes()->getValue('width'));
    $this->assertSame(200, $img->attributes()->getValue('height'));
  }

  /**
   * @depends testConstructor
   * 
   * @param  Img $img
   * @return Img
   */
  public function testUseMap(Img $img): Img {
    $map = new Map('foo-map');
    $img->useMap($map);
    $this->assertSame("#{$map->getName()}", $img->attributes()->getValue('usemap'));
    return $img;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Img $img
   * @return void
   */
  public function testSetLoading(Img $img): void {
    $this->assertFalse($img->attributeExists('loading'));
    $this->assertSame($img, $img->setLoading('lazy'));
    $this->assertSame('lazy', $img->attributes()->getValue('loading'));
  }

}
