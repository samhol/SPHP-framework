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
use Sphp\Html\Media\Multimedia\Track;

/**
 * Class TrackTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TrackTest extends TestCase {

  public function sourceData(): array {
    $data = [];
    $data[] = ['subtitles.vtt'];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $src
   */
  public function testSourceTypes(string $src): void {
    $track = new Track($src);
    $this->assertEquals($src, $track->getAttribute('src'));
    $this->assertEquals($src, $track->getSrc());
    $this->assertEquals(null, $track->getKind());
  }

  public function settersData(): array {
    $data = [];
    $data[] = [['src' => 'subtitles.vtt', 'kind' => 'subtitles']];
    return $data;
  }

  /**
   * @return Track
   */
  public function testKind(): Track {
    $track = new Track('subtitles.vtt');
    $this->assertSame(null, $track->getAttribute('kind'));
    $this->assertEquals(null, $track->getKind());
    $this->assertSame($track, $track->setKind('subtitles'));
    $this->assertSame('subtitles', $track->getAttribute('kind'));
    $this->assertSame('subtitles', $track->getKind());
    return $track;
  }

  /**
   * @depends testKind
   * 
   * @param  Track $track
   * @return Track
   */
  public function testLabel(Track $track): Track {
    $this->assertEquals(null, $track->getLabel());
    $this->assertSame($track, $track->setLabel('text track title'));
    $this->assertSame('text track title', $track->getAttribute('label'));
    $this->assertSame('text track title', $track->getLabel());
    return $track;
  }

  /**
   * @depends testLabel
   * 
   * @param  Track $track
   * @return Track
   */
  public function testDefault(Track $track): Track {
    $this->assertfalse($track->isDefault());
    $this->assertfalse($track->attributeExists('default'));
    $this->assertSame($track, $track->setDefault());
    $this->assertTrue($track->getAttribute('default'));
    $this->assertSame($track, $track->setDefault(false));
    $this->assertfalse($track->attributeExists('default'));
    return $track;
  }

  /**
   * @depends testLabel
   * 
   * @param  Track $track
   * @return Track
   */
  public function testSrclang(Track $track): Track {
    $this->assertNull($track->getSrcLang());
    $this->assertfalse($track->attributeExists('srclang'));
    $this->assertSame($track, $track->setSrcLang('no'));
    $this->assertSame('no', $track->getAttribute('srclang'));
    $this->assertSame('no', $track->getSrcLang());
    return $track;
  }

}
