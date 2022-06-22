<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\{
  Picture,
  Img,
  Source
};

/**
 * Class VideoTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PictureTest extends TestCase {

  public function constructorData(): iterable {
    yield ['foo.png', 'baz.gif'];
    yield [new Img('foo.png'), 'baz.gif', new Source('baz.jpg', '(min-width: 1200px)', 'image/jpg')];
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  Img|string $default
   * @return Picture
   */
  public function testConstructor(Img|string $default, string|Source ... $source): Picture {
    $picture = new Picture($default, ...$source);
    $this->assertSame('picture', $picture->getTagName());
    if ($default instanceof Img) {
      $this->assertSame($default, $picture->getImg());
    }
    return $picture;
  }

  public function testAddSourcee(): void {
    $picture = new Picture('foo.png');
    $src = $picture->addNewSource('baz.gif', '(min-width: 1200px)', 100);
    $picture1 = new Picture('foo.png');
    $src1 = new Source('baz.gif', '(min-width: 1200px)');
    $this->assertSame($picture1, $picture1->addSource($src1, 100));
    $this->assertEquals($src, $src1);
    $this->assertEquals($picture, $picture1);
  }

  /**
   * @return void
   */
  public function testOutput(): void {
    $picture = new Picture('foo.png');
    $this->assertStringContainsString($picture->getIterator()->getHtml(), $picture->contentToString());

    $fullTag = "{$picture->getOpeningTag()}{$picture->contentToString()}{$picture->getClosingTag()}";
    $this->assertSame($fullTag, $picture->getHtml());
  }

}
