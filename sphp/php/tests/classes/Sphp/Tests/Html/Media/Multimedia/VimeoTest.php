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

/**
 * Class VimeoTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VimeoTest extends TestCase {

  use MediaPlayerTestTrait;

  public function testConstructor(): VimeoPlayer {
    $id = 'foo';
    $player = new VimeoPlayer($id);
    $this->assertEquals("https://player.vimeo.com/video/$id", (string) $player->createPlayerUrl());
    return $player;
  }

  /**
   * @return VimeoPlayer
   */
  public function testSetControlsColor(): VimeoPlayer {
    $player = new VimeoPlayer('Tn6FLYsKLzY');
    $this->assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('color'));
    $this->assertSame($player, $player->setControlsColor('#fff'));
    $this->assertEquals('fff', $player->createPlayerUrl()->getQuery()->getParameter('color'));
    $this->assertSame($player, $player->setControlsColor(null));
    $this->assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('color'));
    return $player;
  }

  /**
   * @depends testSetControlsColor
   * 
   * @param  VimeoPlayer $player
   * @return VimeoPlayer
   */
  public function testShowVideoTitle(VimeoPlayer $player): VimeoPlayer {
    $this->assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('title'));
    $this->assertSame($player, $player->showVideoTitle(true));
    $this->assertEquals(1, $player->createPlayerUrl()->getQuery()->getParameter('title'));
    $this->assertSame($player, $player->showVideoTitle(false));
    $this->assertEquals(0, $player->createPlayerUrl()->getQuery()->getParameter('title'));
    return $player;
  }

}
