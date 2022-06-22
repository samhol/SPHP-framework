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

  use MediaPlayerTestTrait;

  public function testConstructor(): DailyMotionPlayer {
    $id = 'foo';
    $player = new DailyMotionPlayer($id);
    $this->assertEquals("https://www.dailymotion.com/embed/video/$id", (string) $player->createPlayerUrl());
    return $player;
  }

}
