<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\YoutubePlayer;
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
    $data[] = ['src.mp4'];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $src
   */
  public function testSourceTypes(string $src): void {
    $player = new YoutubePlayer();
    $this->assertEquals($player, $player->setVideoId('foo'));
    $this->assertSame($player, $player->setTitle('foo video'));
  }
}
