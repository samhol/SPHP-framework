<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\GettextFinder;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\PoSearch\Data\GettextFile;
use SplFileInfo;

/**
 * Class GettextFinder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class GettextFileTest extends TestCase {

  public function validPoFiles(): array {
    $pos = glob('./sphp/locale/*/*/*.po');
    $info = [];
    foreach ($pos as $po) {
      $info[] = [new SplFileInfo($po)];
    }
    return $info;
  }

  /**
   * @dataProvider validPoFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void
   */
  public function testConstructor(SplFileInfo $fileInfo): void {
    $file = $this->getMockForAbstractClass(GettextFile::class,[$fileInfo]);
    $this->assertSame($fileInfo, $file->getFileInfo());
    $this->assertSame($fileInfo->getBasename(".{$fileInfo->getExtension()}"), $file->getFileName());
    $this->assertSame(\md5($fileInfo->getRealPath()), $file->getHash());
  }

}
