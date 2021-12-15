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
use Sphp\Html\Media\Multimedia\MediaTag;
use Sphp\Html\Media\Multimedia\Source;
use Sphp\Html\Media\Multimedia\Track;

/**
 * Class MediaTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MediaTagTest extends TestCase {

  public function testConstructor(): MediaTag {
    $video = $this->getMockForAbstractClass(MediaTag::class, ['video']);
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
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testSetSources(MediaTag $mediaTag): MediaTag {
    $source[] = new Source('foo.mp4');
    $source[] = new Source('foo.mkv');
    $source[] = new Source('foo.mp3');
    $track[] = new Track('foo.vtt');
    $track[] = new Track('bar.vtt');
    $this->assertEquals($source[0], $mediaTag->addSource('foo.mp4'));
    $this->assertEquals($source[1], $mediaTag->addSource('foo.mkv'));
    $this->assertEquals($source[2], $mediaTag->addSource('foo.mp3'));
    $this->assertEquals($track[0], $mediaTag->addTrack('foo.vtt'));
    $this->assertEquals($track[1], $mediaTag->addTrack('bar.vtt'));
    return $mediaTag;
  }

  /**
   * @depends testSetSources
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testIterator(MediaTag $mediaTag): MediaTag {
    $source[] = new Source('foo.mp4');
    $source[] = new Source('foo.mkv');
    $source[] = new Source('foo.mp3');
    $track[] = new Track('foo.vtt');
    $track[] = new Track('bar.vtt');
    $this->assertEqualsCanonicalizing($source, iterator_to_array($mediaTag->getSources()));
    $this->assertEqualsCanonicalizing($track, iterator_to_array($mediaTag->getTracks()));
    return $mediaTag;
  }

  /**
   * @depends testSetSources
   * 
   * @param  MediaTag $tag
   * @return MediaTag
   */
  public function testCount(MediaTag $tag): MediaTag {
    $sourceCount = $tag->getSources()->count();
    $trackCount = $tag->getTracks()->count();
    $this->assertCount($sourceCount + $trackCount, $tag);
    $this->assertSame($sourceCount, $tag->count(MediaTag::SOURCES));
    $this->assertEqualsCanonicalizing($trackCount, $tag->count(MediaTag::TRACKS));

    return $tag;
  }

  /**
   * @depends testConstructor
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testAutoplay(MediaTag $mediaTag): MediaTag {
    $this->assertFalse($mediaTag->attributeExists('autoplay'));
    $this->assertSame($mediaTag, $mediaTag->autoplay(true));
    $this->assertTrue($mediaTag->getAttribute('autoplay'));
    $this->assertSame($mediaTag, $mediaTag->autoplay(false));
    $this->assertFalse($mediaTag->attributeExists('autoplay'));
    return $mediaTag;
  }

  /**
   * @depends testConstructor
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testDisplayControls(MediaTag $mediaTag): MediaTag {
    $this->assertFalse($mediaTag->attributeExists('controls'));
    $this->assertSame($mediaTag, $mediaTag->displayControls(true));
    $this->assertTrue($mediaTag->getAttribute('controls'));
    $this->assertSame($mediaTag, $mediaTag->displayControls(false));
    $this->assertFalse($mediaTag->attributeExists('controls'));
    return $mediaTag;
  }

  /**
   * @depends testConstructor
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testLoop(MediaTag $mediaTag): MediaTag {
    $this->assertFalse($mediaTag->attributeExists('loop'));
    $this->assertSame($mediaTag, $mediaTag->loop(true));
    $this->assertTrue($mediaTag->getAttribute('loop'));
    $this->assertSame($mediaTag, $mediaTag->loop(false));
    $this->assertFalse($mediaTag->attributeExists('loop'));
    return $mediaTag;
  }

  /**
   * @depends testConstructor
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testSetPreload(MediaTag $mediaTag): MediaTag {
    $this->assertFalse($mediaTag->attributeExists('preload'));
    $this->assertSame($mediaTag, $mediaTag->setPreload('auto'));
    $this->assertSame('auto', $mediaTag->getAttribute('preload'));
    $this->assertSame($mediaTag, $mediaTag->setPreload(null));
    $this->assertNull($mediaTag->getAttribute('preload'));
    $this->assertFalse($mediaTag->attributeExists('preload'));
    return $mediaTag;
  }

  /**
   * @depends testConstructor
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testMute(MediaTag $mediaTag): MediaTag {
    $this->assertFalse($mediaTag->attributeExists('muted'));
    $this->assertSame($mediaTag, $mediaTag->mute(true));
    $this->assertSame(true, $mediaTag->getAttribute('muted'));
    $this->assertSame($mediaTag, $mediaTag->mute(false));
    $this->assertFalse($mediaTag->attributeExists('muted'));
    return $mediaTag;
  }

  /**
   * @depends testSetSources
   * 
   * @param  MediaTag $mediaTag
   * @return MediaTag
   */
  public function testOutput(MediaTag $mediaTag): MediaTag {
    $this->assertStringContainsString($mediaTag->getIterator()->getHtml(), $mediaTag->contentToString());
    $fullTag = "<{$mediaTag->getTagName()} {$mediaTag->attributes()}>{$mediaTag->contentToString()}</{$mediaTag->getTagName()}>";
    $this->assertSame($fullTag, $mediaTag->getHtml());
    return $mediaTag;
  }

}
