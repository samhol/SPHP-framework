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
use Sphp\Html\Media\Multimedia\LazySource;
use Sphp\Html\Utils\Mime;

/**
 * Class SourceTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazySourceTest extends TestCase {

  public function sourceData(): array {
    $data = [];
    $data[] = ['src.mp4'];
    return $data;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param  string $src
   * @return Source
   */
  public function testConstructor(string $src): LazySource {
    $source = new LazySource($src);
    $this->assertSame('source', $source->getTagName());
    $this->assertSame($src, $source->getSrc());
    $this->assertSame($src, $source->getAttribute('data-src'));
    $this->assertFalse($source->attributeExists('src'));
    $this->assertSame(Mime::getMime($src), $source->getType());
    $this->assertSame(Mime::getMime($src), $source->getAttribute('type'));
    return $source;
  }

  /**
   * @return LazySource
   */
  public function testSetAndGetSrc(): LazySource {
    $source = new LazySource('bar.mp3');
    $this->assertSame($source, $source->setSrc('baz.mp3'));
    $this->assertSame('baz.mp3', $source->getSrc());
    $this->assertSame('baz.mp3', $source->getAttribute('data-src'));
    return $source;
  }

}
