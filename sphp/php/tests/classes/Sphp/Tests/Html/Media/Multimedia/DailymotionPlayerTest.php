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
use Sphp\Html\Media\Multimedia\DailyMotionPlayer;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Class YoutubePlayerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DailymotionPlayerTest extends TestCase {

  public function sourceData(): array {
    $data = [];
    $data[] = ['x7tgad0'];
    $data[] = ['x2kjiom'];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $id
   */
  public function testConstructor(string $id): void {
    $player = new DailyMotionPlayer($id);
    $iframe = $player->createIframe();
    $url = $player->getUrlCopy();
    $this->assertStringStartsWith("https://www.dailymotion.com/embed/video/$id", (string) $url);
    $this->assertSame((string) $url, (string) $iframe->getSrc());
  }

  /**
   * @return DailyMotionPlayer
   */
  public function testMute(): DailyMotionPlayer {
    $player = new DailyMotionPlayer('x7tgad0');
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('mute'));
    $this->assertSame($player, $player->mute(true));
    $this->assertEquals('1', $player->getUrlCopy()->getQuery()->getParameter('mute'));
    $this->assertSame($player, $player->mute(false));
    $this->assertEquals('0', $player->getUrlCopy()->getQuery()->getParameter('mute'));
    return $player;
  }

  /**
   * @depends testMute
   * 
   * @param  DailyMotionPlayer $player
   * @return DailyMotionPlayer
   */
  public function testDisplayControls(DailyMotionPlayer $player): DailyMotionPlayer {
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('controls'));
    $this->assertSame($player, $player->displayControls(true));
    $this->assertEquals('1', $player->getUrlCopy()->getQuery()->getParameter('controls'));
    $this->assertSame($player, $player->displayControls(false));
    $this->assertEquals('0', $player->getUrlCopy()->getQuery()->getParameter('controls'));
    return $player;
  }

}
