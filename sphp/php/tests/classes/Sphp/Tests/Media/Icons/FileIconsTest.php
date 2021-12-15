<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Icons\FileIcons;
use Sphp\Html\Media\Icons\FileTypeIconMapper;
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

  public function testConstructor(): FileIcons {
    $factory = new FileIcons();
    $map = FileTypeIconMapper::instance();
    //print_r($map->toArray());
    foreach ($map->toArray() as $ext => $iconName) {
      $iconFor = $factory->iconFor($ext);
      $this->assertTrue($iconFor->cssClasses()->contains($iconName));
      $this->assertSame('i', $iconFor->getTagName());
      $invoked = $factory($ext);
      $this->assertTrue($invoked->cssClasses()->contains($iconName));
      $this->assertSame('i', $invoked->getTagName());
      $call = $factory->$ext($ext);
      $this->assertTrue($call->cssClasses()->contains($iconName));
      $this->assertSame('i', $call->getTagName());
      $static = FileIcons::$ext($ext);
      $this->assertTrue($static->cssClasses()->contains($iconName));
      $this->assertSame('i', $static->getTagName());
    }

    return $factory;
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
   * @return FileIcons
   */
  public function testCorrectFilesAndExtensions($fileOrExt): FileIcons {
    $factory = new FileIcons();
    $iconFor = $factory->iconFor($fileOrExt);
    //$this->assertTrue($iconFor->cssClasses()->contains($iconName));
    $this->assertSame('i', $iconFor->getTagName());
    $invoked = $factory($fileOrExt);
    //$this->assertTrue($invoked->cssClasses()->contains($iconName));
    $this->assertSame('i', $invoked->getTagName());


    return $factory;
  }

  public function testInvocationFailure(): void {
    $factory = new FileIcons();
    $this->expectException(InvalidArgumentException::class);
    $factory(new \stdClass);
  }

  public function testMagicCallFailure(): void {
    $factory = new FileIcons();
    $this->expectException(BadMethodCallException::class);
    $factory->{''}();
  }

  public function testMagicStaticCallFailure(): void {
    $this->expectException(BadMethodCallException::class);
    FileIcons::{''}();
  }

}
