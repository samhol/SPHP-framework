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
use Sphp\Html\Media\Multimedia\LazyVideo;
use Sphp\Html\Media\Multimedia\LazySource;

/**
 * Class LazyVideoTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazyVideoTest extends TestCase {

  public function testConstructor(): LazyVideo {
    $video = new LazyVideo();
    $this->assertSame('video', $video->getTagName());
    $this->assertFalse($video->attributeExists('data-poster'));
    $this->assertFalse($video->attributeExists('poster'));
    $this->assertFalse($video->attributeExists('controls'));
    $this->assertFalse($video->attributeExists('autoplay'));
    $this->assertFalse($video->attributeExists('loop'));
    $this->assertFalse($video->attributeExists('muted'));
    return $video;
  }

  /**
   * @depends testConstructor
   * 
   * @param  LazyVideo $video
   * @return LazyVideo
   */
  public function testSetLazySources(LazyVideo $video): LazyVideo {
    $source = new LazySource('foo.mp4');
    $this->assertEquals($source, $video->addSource('foo.mp4'));
    return $video;
  }

  /**
   * @depends testSetLazySources
   * 
   * @param  LazyVideo $video
   * @return LazyVideo
   */
  public function testSetPoster(LazyVideo $video): LazyVideo {
    $this->assertFalse($video->attributeExists('data-poster'));
    $this->assertSame($video, $video->setPoster('foo.png'));
    $this->assertSame('foo.png', $video->getAttribute('data-poster'));
    $this->assertSame($video, $video->setPoster(null));
    $this->assertFalse($video->attributeExists('data-poster'));
    return $video;
  }

}
