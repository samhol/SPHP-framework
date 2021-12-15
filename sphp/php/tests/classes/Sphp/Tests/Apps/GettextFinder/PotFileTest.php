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
use Sphp\Apps\PoSearch\Data\PotFile;
use Sphp\Apps\PoSearch\Exceptions\GettextException;

/**
 * Class PotFileTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PotFileTest extends TestCase {

  public function validFiles(): array {
    $pos = glob('./sphp/locale/*.pot');
    $info = [];
    foreach ($pos as $pot) {
      $info[] = [new SplFileInfo($pot)];
    }
    return $info;
  }

  /**
   * @dataProvider validFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void
   */
  public function testConstructor(SplFileInfo $fileInfo): void {
    $file = new PotFile($fileInfo);
    $this->assertSame($fileInfo, $file->getFileInfo());
  }

  public function invalidFiles(): array {
    $info = [];
    $info[] = [new SplFileInfo(__FILE__)];
    $info[] = [new SplFileInfo(__DIR__)];
    $info[] = [new SplFileInfo('./sphp/locale/fi_FI/LC_MESSAGES/sphp-datetime.po')];
    return $info;
  }

  /**
   * @dataProvider invalidFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void 
   */
  public function testInvalidConstructor(SplFileInfo $fileInfo): void {
    $this->expectException(GettextException::class);
    new PotFile($fileInfo);
  }

  public function hasPoFiles(): array {
    $pos = glob('./sphp/locale/*.pot');
    $info = [];
    foreach ($pos as $pot) {
      $info[] = [new SplFileInfo($pot)];
    }
    return $info;
  }

  /**
   * @dataProvider hasPoFiles
   * 
   * @param  SplFileInfo $fileInfo
   * @return void 
   */
  public function testPoFiles(SplFileInfo $fileInfo): void {
    $file = new PotFile($fileInfo);
    $this->assertSame($fileInfo, $file->getFileInfo());
  }

}
