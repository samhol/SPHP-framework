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
use Sphp\Html\Media\Multimedia\VimeoPlayer;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Class VimeoTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VimeoTest extends TestCase {

  public function sourceData(): array {
    $data = [];
    $data[] = ['Tn6FLYsKLzY'];
    $data[] = ['iyh4Vo0qgAg'];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $videoId
   */
  public function testSourceTypes(string $videoId): void {
    $player = new VimeoPlayer($videoId);
    $iframe = $player->createIframe();
    $url = $player->getUrlCopy();
    $this->assertStringStartsWith("https://player.vimeo.com/video/$videoId", (string) $url);
    $this->assertStringStartsWith("https://player.vimeo.com/video/$videoId", $iframe->getSrc());
  }

  /**
   * @return VimeoPlayer
   */
  public function testSetControlsColor(): VimeoPlayer {
    $player = new VimeoPlayer('Tn6FLYsKLzY');
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('color'));
    $this->assertSame($player, $player->setControlsColor('#fff'));
    $this->assertEquals('fff', $player->getUrlCopy()->getQuery()->getParameter('color'));
    $this->assertSame($player, $player->setControlsColor(null));
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('color'));
    return $player;
  }

  /**
   * @depends testSetControlsColor
   * 
   * @param  VimeoPlayer $player
   * @return VimeoPlayer
   */
  public function testShowVideoTitle(VimeoPlayer $player): VimeoPlayer {
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('title'));
    $this->assertSame($player, $player->showVideoTitle(true));
    $this->assertEquals('1', $player->getUrlCopy()->getQuery()->getParameter('title'));
    $this->assertSame($player, $player->showVideoTitle(false));
    $this->assertEquals('0', $player->getUrlCopy()->getQuery()->getParameter('title'));
    return $player;
  }

}
