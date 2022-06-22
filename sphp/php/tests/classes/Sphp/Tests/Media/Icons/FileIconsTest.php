<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Media\Icons\FileIcons;
use Sphp\Media\Icons\FileTypeIcons;
use Sphp\Media\Icons\FileTypeIconMapper;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implementation of FileIconsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FileIconsTest extends TestCase {

  protected FileTypeIcons $icons;

  protected function setUp(): void {
    $this->icons = FileTypeIcons::defaultSet();
  }

  public function corretFilesAndExtensions(): array {
    $data = [];
    $data[] = ['exe'];
    $data[] = ['tar.gz'];
    $data[] = ['tar.gz'];
    $data[] = ['./sphp/php/tests/files/image.gif'];
    $data[] = [new \SplFileObject('./sphp/php/tests/files/image.gif')];
    $data[] = [new \SplFileInfo('./sphp/php/tests/files/image.gif')];
    return $data;
  }

  /**
   * @dataProvider corretFilesAndExtensions
   * @param  mixed $fileOrExt
   * @return void
   */
  public function testCorrectFilesAndExtensions($fileOrExt): void {
    $iconFor = $this->icons->createIconFor($fileOrExt);
    //$this->assertTrue($iconFor->cssClasses()->contains($iconName));
    $this->assertSame('i', $iconFor->createTag()->getTagName());
    $factory = $this->icons;
    $invoked = $factory($fileOrExt);
    //$this->assertTrue($invoked->cssClasses()->contains($iconName));
    $this->assertSame('i', $invoked->createTag()->getTagName());
  }

}
