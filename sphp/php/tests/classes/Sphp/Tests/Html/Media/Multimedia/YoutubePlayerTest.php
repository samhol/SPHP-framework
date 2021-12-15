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

  public function sourceData(): array {
    $data = [];
    $data[] = ['Tn6FLYsKLzY', false];
    $data[] = ['iyh4Vo0qgAg', true];
    return $data;
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

  public function autohideValue(): array {
    $data = [];
    $data[] = [-1];
    $data[] = [null];
    $data[] = [0];
    $data[] = [1];
    $data[] = [2];
    $data[] = [4];
    return $data;
  }

  /**
   * @dataProvider autohideValue
   * 
   * @param  int|null $autohide
   * @return void
   */
  public function testAutohide(int $autohide = null) {
    $player = new YoutubePlayer('Tn6FLYsKLzY');
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('autohide'));
    if ($autohide < 0 || $autohide > 2) {
      $this->expectException(VideoPlayerException::class);
    }
    $this->assertSame($player, $player->autohide($autohide));
    if ($autohide === null) {
      $this->assertNull($player->getUrlCopy()->getQuery()->getParameter('autohide'));
    } else {
      $this->assertEquals($autohide, $player->getUrlCopy()->getQuery()->getParameter('autohide'));
    }
  }

  public function validTimeIntervals(): array {
    $data = [];
    $data[] = [null, null];
    $data[] = [null, 2];
    $data[] = [0, 2];
    $data[] = [1, null];
    return $data;
  }

  /**
   * @dataProvider validTimeIntervals
   * 
   * @param  int $start
   * @param  int $end
   * @return void
   */
  public function testsetTimeIterval(int $start = null, int $end = null): void {
    $player = new YoutubePlayer('Tn6FLYsKLzY');
    $q1 = $player->getUrlCopy()->getQuery();
    $this->assertFalse($q1->hasParameter('start'));
    $this->assertFalse($q1->hasParameter('end'));
    $this->assertSame($player, $player->setTimeInterval($start, $end));
    $q2 = $player->getUrlCopy()->getQuery();
    $this->assertEquals($start, $q2->getParameter('start'));
    $this->assertEquals($end, $q2->getParameter('end'));
  }

  public function invalidTimeIntervals(): array {
    $data = [];
    $data[] = [-1, null];
    $data[] = [null, -2];
    $data[] = [3, 2];
    $data[] = [1, -1];
    $data[] = [-4, -1];
    return $data;
  }

  /**
   * @dataProvider invalidTimeIntervals
   * 
   * @param  int $start
   * @param  int $end
   * @return void
   */
  public function testsetInvalidTimeIterval(int $start = null, int $end = null): void {
    $player = new YoutubePlayer('Tn6FLYsKLzY');
    $this->expectException(VideoPlayerException::class);
    $player->setTimeInterval($start, $end);
  }

}
