<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Image;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Image\SvgLoader;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\FileSystemException;

/**
 * Implementation of SvgLoaderTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SvgLoaderTest extends TestCase {

  public function testFactorizing(): void {
    $loader = SvgLoader::instance();
    $another = SvgLoader::instance();
    $this->assertSame($loader, $another);
  }

  public function testCreating(): void {
    $loader = new SvgLoader();
    $svgFromFile = $loader->fileToObject('./sphp/php/tests/files/human-skull.svg');
    $this->assertCount(1, $svgFromFile->getDoc()->getElementsByTagName('svg'));
    $svgFromUrl = $loader->fromUrl('http://playground.samiholck.com/manual/svg/svg.php?name=human-skull');
    $this->assertCount(1, $svgFromUrl->getDoc()->getElementsByTagName('svg'));
  }

  public function testInvalidUrl(): void {
    $loader = new SvgLoader();
    $this->expectException(InvalidArgumentException::class);
    $loader->fromUrl('http://foo');
  }

  public function testUrlContainsNoSvg(): void {
    $loader = new SvgLoader();
    $this->expectException(InvalidArgumentException::class);
    $loader->fromUrl('http://samiholck.com');
  }

  public function testInvalidLocalFile(): void {
    $loader = new SvgLoader();
    $this->expectException(FileSystemException::class);
    $loader->fileToObject('./foo');
  }

  public function testLocalFileContainsNoSvg(): void {
    $loader = new SvgLoader();
    $this->expectException(InvalidArgumentException::class);
    $loader->fileToObject('./sphp/php/tests/files/image.gif');
  }

}
