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
use Sphp\Html\Media\Multimedia\YoutubePlayer;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Class YoutubePlayerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class YoutubePlayerTest extends TestCase {

  use MediaPlayerTestTrait;

  public function testConstructor(): YoutubePlayer {
    $id = 'foo';
    $player = new YoutubePlayer($id);
    $this->assertEquals("https://www.youtube.com/embed/$id", (string) $player->createPlayerUrl());
    return $player;
  }

  public function sourceData(): iterable {
    yield ['Tn6FLYsKLzY', false];
    yield ['iyh4Vo0qgAg', true];
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $src
   */
  public function testSourceTypes(string $src, bool $isPlaylist): void {
    $player = new YoutubePlayer($src, $isPlaylist);
    $iframe = $player->createIframe();
    $url = new \Sphp\Network\URL($iframe->getSrc());
    if ($isPlaylist) {
      $this->assertStringStartsWith('https://www.youtube.com/embed/', $iframe->getSrc());
      $this->assertTrue($url->getQuery()->hasParameter('listType'));
    } else {
      $this->assertStringStartsWith("https://www.youtube.com/embed/$src", $iframe->getSrc());
    }
  }

  public function autohideValue(): iterable {
    yield [-1, false];
    yield [0, true];
    yield [1, true];
    yield [2, true];
    yield [3, false];
  }

  /**
   * @dataProvider autohideValue
   *  
   * @param  int $autohide
   * @param  bool $isValid
   * @return void
   */
  public function testAutohide(int $autohide, bool $isValid): void {
    $player = new YoutubePlayer('Tn6FLYsKLzY');
    $this->assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('autohide'));
    if (!$isValid) {
      $this->expectException(VideoPlayerException::class);
    }
    $this->assertSame($player, $player->autohide($autohide));
    $this->assertEquals($autohide, $player->createPlayerUrl()->getQuery()->getParameter('autohide'));
  }

  public function timeIntervals(): iterable {
    yield [null, null, true];
    yield [null, 2, true];
    yield [0, 2, true];
    yield [1, null, true];
    yield [-1, null, false];
    yield [null, -2, false];
    yield [3, 2, false];
    yield [1, -1, false];
    yield [-1, -1, false];
  }

  /**
   * @dataProvider timeIntervals
   * 
   * @param  int|null $start
   * @param  int|null $end
   * @param  bool $isValid
   * @return void
   */
  public function testsetTimeIterval(?int $start, ?int $end, bool $isValid): void {
    $player = new YoutubePlayer('Tn6FLYsKLzY');
    if (!$isValid) {
      $this->expectException(VideoPlayerException::class);
      $player->setTimeInterval($start, $end);
    } else {
      $q1 = $player->createPlayerUrl()->getQuery();
      $this->assertFalse($q1->hasParameter('start'));
      $this->assertFalse($q1->hasParameter('end'));
      $this->assertSame($player, $player->setTimeInterval($start, $end));
      $q2 = $player->createPlayerUrl()->getQuery();
      $this->assertEquals($start, $q2->getParameter('start'));
      $this->assertEquals($end, $q2->getParameter('end'));
    }
  }

}
