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
use Sphp\Html\Media\Multimedia\Video;

/**
 * Class VideoTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VideoTest extends TestCase {

  use \Sphp\Tests\Html\Media\SizeableMediaTestTrait;

  public function testConstructor(): Video {
    $video = new Video();
    $this->assertSame('video', $video->getTagName());
    $this->assertFalse($video->attributeExists('controls'));
    $this->assertFalse($video->attributeExists('autoplay'));
    $this->assertFalse($video->attributeExists('loop'));
    $this->assertFalse($video->attributeExists('muted'));
    return $video;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Video $video
   * @return Video
   */
  public function testSetPoster(Video $video): Video {
    $this->assertFalse($video->attributeExists('poster'));
    $this->assertSame($video, $video->setPoster('foo.png'));
    $this->assertSame('foo.png', $video->getAttribute('poster'));
    $this->assertSame($video, $video->setPoster(null));
    $this->assertFalse($video->attributeExists('poster'));
    return $video;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Video $video
   * @return Video
   */
  public function testSetSize(Video $video): Video {
    $this->assertSame(null, $video->attributes()->getValue('width'));
    $this->assertSame(null, $video->attributes()->getValue('height'));
    $this->assertSame($video, $video->setSize(100, 200));
    $this->assertSame(100, $video->attributes()->getValue('width'));
    $this->assertSame(200, $video->attributes()->getValue('height'));
    $this->assertSame($video, $video->setSize(100, null));
    $this->assertSame(100, $video->attributes()->getValue('width'));
    $this->assertSame(null, $video->attributes()->getValue('height'));
    $this->assertSame($video, $video->setSize(null, 200));
    $this->assertSame(null, $video->attributes()->getValue('width'));
    $this->assertSame(200, $video->attributes()->getValue('height'));
    return $video;
  }

  /**
   * @depends testSetPoster
   * 
   * @param  Video $video
   * @return Video
   */
  public function testOutput(Video $video): Video {
    $this->assertStringContainsString($video->getIterator()->getHtml(), $video->contentToString());
    $video->autoplay();
    $fullTag = "<{$video->getTagName()} {$video->attributes()}>{$video->contentToString()}</{$video->getTagName()}>";
    $this->assertSame($fullTag, $video->getHtml());
    return $video;
  }

}
