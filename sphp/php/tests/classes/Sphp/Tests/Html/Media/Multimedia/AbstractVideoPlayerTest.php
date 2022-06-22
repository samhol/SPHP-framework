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
use Sphp\Html\Media\Multimedia\AbstractVideoPlayer;
use Sphp\Network\URL;
use Sphp\Html\Media\Multimedia\LazyIframe;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Class AbstractVideoPlayerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractVideoPlayerTest extends TestCase {

  public function createObject(URL $url = null): AbstractVideoPlayer {
    if ($url === null) {
      $url = new URL('https://www.youtube.com/embed/iyh4Vo0qgAg');
    }
    $mock = $this->getMockForAbstractClass(AbstractVideoPlayer::class, [$url]);
    return $mock;
  }

  public function sourceData(): array {
    $data = [];
    $data[] = [new URL('https://www.youtube.com/embed/iyh4Vo0qgAg')];
    $data[] = [new URL('https://www.youtube.com/embed/iyh4Vo0qgAg')];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param string $url
   */
  public function testSourceTypes(URL $url): void {
    $player = $this->createObject($url);
    $urlCopy = $player->createPlayerUrl();
    $this->assertEquals($url, $urlCopy);
    $this->assertNotSame($url, $urlCopy);
    $iframe1 = $player->createIframe();
    $iframe2 = $player->createIframe();
    $this->assertEquals($iframe1, $iframe2);
    $this->assertNotSame($iframe1, $iframe2);
  }

  public function validOptions(): iterable {
    yield ['foo', true];
    yield ['foo', false];
    yield ['foo', 0];
    yield ['foo', 3.1415];
    yield ['foo', 'bar'];
  }

  /**
   * @dataProvider validOptions
   *
   * @param  string $name
   * @param  string|int|float|bool|null $value
   * @return void
   */
  public function testSetOptions(string $name, string|int|float|bool|null $value): void {
    $player = $this->createObject();
    $this->assertSame($player, $player->setOption($name, $value));
    $expected = is_bool($value) ? (int) $value : $value;
    $this->assertSame($expected, $player->createPlayerUrl()->getQuery()->getParameter($name));
    $this->assertSame($player, $player->setOption($name, null));
    $this->assertFalse($player->createPlayerUrl()->getQuery()->hasParameter($name));
    $this->assertSame(null, $player->createPlayerUrl()->getQuery()->getParameter($name));
  }

  public function sizeParameters(): array {
    $data = [];
    $data[] = [1, 2];
    $data[] = [null, 2];
    $data[] = [1, null];
    $data[] = [null, null];
    return $data;
  }

  /**
   * @dataProvider sizeParameters
   */
  public function testSetSize(int $width = null, int $height = null): void {
    $player = $this->createObject();
    $this->assertSame($player, $player->setSize($width, $height));
    $iframe = $player->createIframe();
    $this->assertSame($width, $iframe->getAttribute('width'));
    $this->assertSame($height, $iframe->getAttribute('height'));
  }

  /**
   * @dataProvider sizeParameters
   */
  public function testSetLoading(): void {
    $player = $this->createObject();
    $this->assertFalse($player->createIframe()->attributeExists('loading'));
    $this->assertSame($player, $player->setLoading('lazy'));
    $this->assertSame('lazy', $player->createIframe()->getAttribute('loading'));
  }

  public function testOutput(): void {
    $lazyPlayer = $this->createObject()->setLoading('eager');
    $lazyFrame = $lazyPlayer->createIframe();
    $this->assertStringContainsString($lazyFrame->getHtml(), $lazyPlayer->getHtml());
    $player = $this->createObject();
    $frame = $player->createIframe();
    $this->assertStringContainsString($frame->getHtml(), $player->getHtml());
  }

  public function testClone(): void {
    $player = $this->createObject();
    $clone = clone $player;
    $this->assertNotSame($clone, $player);
    $this->assertEquals($clone, $player);
    $player->setOption('foo', 'bar');
    $this->assertNotEquals($clone, $player);
  }

  public function validIframeAttributes(): array {
    $data = [];
    $data[] = ['foo', true];
    $data[] = ['foo', false];
    $data[] = ['foo', 0];
    $data[] = ['foo', 'bar'];
    return $data;
  }

}
