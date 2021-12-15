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
use Sphp\Apps\PoSearch\Data\PoEntryCollection;
use Sphp\Apps\PoSearch\Data\MoFile;

/**
 * Class PotFileTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PoFileTest extends TestCase {

  public function validFiles(): iterable {
    $pos = glob('./sphp/locale/*/*/*.po');
    foreach ($pos as $po) {
      yield [new SplFileInfo($po)];
    }
  }

  /**
   * @dataProvider validFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void
   */
  public function testConstructor(SplFileInfo $fileInfo): void {
    $file = new PoFile($fileInfo);
    //echo $fileInfo->getBasename()."\n";
    $this->assertSame($fileInfo, $file->getFileInfo());
    $this->assertEquals(PoEntryCollection::fromFile($fileInfo->getRealPath()), $file->getEntryCollection());
    if (is_file($fileInfo->getPath() . '/' . $fileInfo->getBasename('.po') . '.mo')) {
      $this->assertTrue($file->hasMoFile());
      $mo = $file->getMoFile();
      $this->assertInstanceOf(MoFile::class, $mo);
    } else {
      $this->assertFalse($file->hasMoFile());
      $this->assertNull($file->getMoFile());
    }
  }

}
