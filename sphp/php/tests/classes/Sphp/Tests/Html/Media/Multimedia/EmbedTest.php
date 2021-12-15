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
use Sphp\Html\Media\Multimedia\Embed;

/**
 * Class EmbedTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EmbedTest extends TestCase {

  /**
   * @return string[]
   */
  public function constructorParameters(): array {
    return [
        ['snippet.html', 'text/html'],
        ['pic_trulli.jpg', 'f1'],
        ['foo.bar', 'f1'],
    ];
  }

  /**
   * @return Embed
   */
  public function testConstructor(): Embed {
    $src = 'https://foo.com';
    $embed = new Embed($src);
    $this->assertSame($src, $embed->getSrc());
    $this->assertSame($src, $embed->getAttribute('src'));
    return $embed;
  }

  /**
   * @depends testConstructor
   * 
   * @param Embed $embed
   */
  public function testType(Embed $embed): Embed {
    $name = 'foo';
    $this->assertNull($embed->getAttribute('type'));
    $this->assertSame($embed, $embed->setType($name));
    $this->assertSame($name, $embed->getType());
    $this->assertSame($name, $embed->getAttribute('type'));
    return $embed;
  }

}
