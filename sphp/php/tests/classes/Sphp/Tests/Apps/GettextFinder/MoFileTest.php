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
use SplFileInfo;
use Sphp\Apps\PoSearch\Data\PoFile;
use Sphp\Apps\PoSearch\Data\MoFile;

/**
 * Class MoFileTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MoFileTest extends TestCase {

  public function validMoFiles(): array {
    $pos = glob('./sphp/locale/*/*/*.mo');
    // print_r($pos);
    $info = [];
    foreach ($pos as $po) {
      $info[] = [new SplFileInfo($po)];
    }
    return $info;
  }

  /**
   * @dataProvider validMoFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void
   */
  public function testConstructor(SplFileInfo $fileInfo): void {
   // print_r($fileInfo);
    $file = new MoFile($fileInfo);
    $this->assertSame($fileInfo, $file->getFileInfo());
    //$this->assertEquals(new PoEntryCollection($fileInfo->getRealPath()), $file->getEntryCollection());
    if (is_file($fileInfo->getPath() . '/' . $file->getFileName() . '.po')) {
      $this->assertTrue($file->hasPoFile());
      $po = $file->getPoFile();
      $this->assertInstanceOf(PoFile::class, $po);
    } else {
      $this->assertFalse($file->hasPoFile());
      $this->assertNull($file->getPoFile());
    }
  }

}
