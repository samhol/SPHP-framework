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
use Sphp\Html\Media\Multimedia\Source;
use Sphp\Html\Utils\Mime;

/**
 * Class SourceTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SourceTest extends TestCase {

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
  public function testConstructor(string $src): Source {
    $source = new Source($src);
    $this->assertSame('source', $source->getTagName());
    $this->assertSame($src, $source->getSrc());
    $this->assertSame($src, $source->getAttribute('src'));
    $this->assertSame(Mime::getMime($src), $source->getType());
    $this->assertSame(Mime::getMime($src), $source->getAttribute('type'));
    return $source;
  }

  /**
   * @dataProvider sourceData
   * 
   * @param  string $src
   * @return Source
   */
  public function testSourceAndSourceType(string $src): Source {
    $source = new Source('foo.bar');
    $this->assertSame($source, $source->setSrc($src));
    $this->assertSame($source, $source->setType('foo'));
    $this->assertSame('foo', $source->getType());
    return $source;
  }

}
