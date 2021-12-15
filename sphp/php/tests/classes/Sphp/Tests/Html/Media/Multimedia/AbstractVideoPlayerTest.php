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
    $urlCopy = $player->getUrlCopy();
    $this->assertEquals($url, $urlCopy);
    $this->assertNotSame($url, $urlCopy);
    $iframe1 = $player->createIframe();
    $iframe2 = $player->createIframe();
    $this->assertEquals($iframe1, $iframe2);
    $this->assertNotSame($iframe1, $iframe2);
  }

  public function validOptions(): array {
    $data = [];
    $data[] = ['foo', true];
    $data[] = ['foo', false];
    $data[] = ['foo', 0];
    $data[] = ['foo', 'bar'];
    return $data;
  }

  /**
   * @dataProvider validOptions
   */
  public function testSetOptions(string $name, $value): void {
    $player = $this->createObject();
    $this->assertSame($player, $player->setOption($name, $value));
    $this->assertSame($value, $player->getUrlCopy()->getQuery()->getParameter($name));
    $this->assertSame($player, $player->setOption($name, null));
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter($name));
    $this->assertSame(null, $player->getUrlCopy()->getQuery()->getParameter($name));
  }

  public function invalidOptions(): array {
    $data = [];
    $data[] = ['object', new \stdClass()];
    $data[] = ['array', []];
    return $data;
  }

  /**
   * @dataProvider invalidOptions
   *
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testSetInvalidOptions(string $name, $value): void {
    $player = $this->createObject();
    $this->expectException(VideoPlayerException::class);
    $player->setOption($name, $value);
  }

  /**
   * @return AbstractVideoPlayer
   */
  public function testAutoplay(): AbstractVideoPlayer {
    $player = $this->createObject();
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('autoplay'));
    $this->assertSame($player, $player->autoplay(true));
    $this->assertEquals('1', $player->getUrlCopy()->getQuery()->getParameter('autoplay'));
    $this->assertSame($player, $player->autoplay(false));
    $this->assertEquals('0', $player->getUrlCopy()->getQuery()->getParameter('autoplay'));
    return $player;
  }

  /**
   * @return AbstractVideoPlayer
   */
  public function testLoop(): AbstractVideoPlayer {
    $player = $this->createObject();
    $this->assertFalse($player->getUrlCopy()->getQuery()->hasParameter('loop'));
    $this->assertSame($player, $player->loop(true));
    $this->assertEquals('1', $player->getUrlCopy()->getQuery()->getParameter('loop'));
    $this->assertSame($player, $player->loop(false));
    $this->assertEquals('0', $player->getUrlCopy()->getQuery()->getParameter('loop'));
    return $player;
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
  public function testLazy(): void {
    $player = $this->createObject();
    $this->assertFalse($player->isLazy());
    $this->assertNotInstanceOf(LazyIframe::class, $notLazy = $player->createIframe());
    $this->assertSame($player, $player->setLazy(true));
    $this->assertTrue($player->isLazy());
    $this->assertInstanceOf(LazyIframe::class, $lazy = $player->createIframe());
  }

  public function testOutput(): void {
    $lazyPlayer = $this->createObject()->setLazy();
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

  /**
   * @dataProvider validIframeAttributes
   * 
   * @param  string $name
   * @param  mixed $value
   */
  public function testSetIframeAttribute(string $name, $value): void {
    $player = $this->createObject();
    $this->assertSame($player, $player->setIframeAttribute($name, $value));
    $this->assertSame($value, $player->createIframe()->getAttribute($name));
    $this->assertSame($player, $player->setIframeAttribute($name, null));
    $this->assertFalse($player->createIframe()->attributeExists($name));
  }

  public function invalidIframeAttributes(): array {
    $data = [];
    $data[] = ['object', new \stdClass()];
    $data[] = ['array', []];
    $data[] = ['src', 'foo'];
    return $data;
  }

  /**
   * @dataProvider invalidIframeAttributes
   *
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testSetInvalidIframeAttributes(string $name, $value): void {
    $player = $this->createObject();
    $this->expectException(VideoPlayerException::class);
    $player->setIframeAttribute($name, $value);
  }

}
