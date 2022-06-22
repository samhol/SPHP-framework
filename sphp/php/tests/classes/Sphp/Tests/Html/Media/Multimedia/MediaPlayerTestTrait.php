<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use Sphp\Html\Media\Multimedia\AbstractVideoPlayer;
use PHPUnit\Framework\Assert;

/**
 * Trait VideoPlayerOptionTestCase
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait MediaPlayerTestTrait {

  abstract public function testConstructor(): AbstractVideoPlayer;

  /**
   * @depends testConstructor
   * 
   * @param  AbstractVideoPlayer $player
   * @return AbstractVideoPlayer
   */
  public function testAutoplay(AbstractVideoPlayer $player): AbstractVideoPlayer {
    Assert::assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('autoplay'));
    Assert::assertSame($player, $player->autoplay(true));
    Assert::assertEquals(1, $player->createPlayerUrl()->getQuery()->getParameter('autoplay'));
    Assert::assertSame($player, $player->autoplay(false));
    Assert::assertEquals(0, $player->createPlayerUrl()->getQuery()->getParameter('autoplay'));
    return $player;
  }

  /**
   * @depends testAutoplay
   * 
   * @param  AbstractVideoPlayer $player
   * @return AbstractVideoPlayer
   */
  public function testDisplayControls(AbstractVideoPlayer $player): AbstractVideoPlayer {
    Assert::assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('controls'));
    Assert::assertSame($player, $player->displayControls(true));
    Assert::assertEquals(1, $player->createPlayerUrl()->getQuery()->getParameter('controls'));
    Assert::assertSame($player, $player->displayControls(false));
    Assert::assertEquals(0, $player->createPlayerUrl()->getQuery()->getParameter('controls'));
    return $player;
  }

  /**
   * @depends testDisplayControls
   * 
   * @param  AbstractVideoPlayer $player
   * @return AbstractVideoPlayer
   */
  public function testMute(AbstractVideoPlayer $player): AbstractVideoPlayer {
    Assert::assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('mute'));
    Assert::assertSame($player, $player->mute(true));
    Assert::assertEquals(1, $player->createPlayerUrl()->getQuery()->getParameter('mute'));
    Assert::assertSame($player, $player->mute(false));
    Assert::assertEquals(0, $player->createPlayerUrl()->getQuery()->getParameter('mute'));
    return $player;
  }

  /**
   * @depends testMute
   * 
   * @param  AbstractVideoPlayer $player
   * @return AbstractVideoPlayer
   */
  public function testLoop(AbstractVideoPlayer $player): AbstractVideoPlayer {
    Assert::assertFalse($player->createPlayerUrl()->getQuery()->hasParameter('loop'));
    Assert::assertSame($player, $player->loop(true));
    Assert::assertEquals(1, $player->createPlayerUrl()->getQuery()->getParameter('loop'));
    Assert::assertSame($player, $player->loop(false));
    Assert::assertEquals(0, $player->createPlayerUrl()->getQuery()->getParameter('loop'));
    return $player;
  }

}
