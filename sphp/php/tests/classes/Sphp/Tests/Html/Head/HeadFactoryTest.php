<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\Exceptions\MetaDataException;
use Sphp\Html\Head\HeadFactory;
use Sphp\Html\Head\Links\ImmutableLinkData;
use Sphp\Html\Head\Base;
use Sphp\Html\Head\Title;

/**
 * Class HeadFactoryTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HeadFactoryTest extends TestCase {

  public function data(): array {

    $y = new \Sphp\Stdlib\Parsers\Yaml();
    return $y->fileToArray('./sivut/html/meta-data.yml');
  }

  public function invalidYamlFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/invalid/empty.yml'];
    $data[] = ['./sphp/php/tests/metadata/invalid/syntax-err.yml'];
    $data[] = ['./sphp/php/tests/metadata/invalid/link-err.yml'];
    $data[] = ['./sphp/php/tests/metadata/invalid/meta-err.yml'];
    return $data;
  }

  /**
   * @dataProvider invalidYamlFiles
   * 
   * @param  string $path
   * @return void
   */
  public function testInvalidYamlFiles(string $path): void {
    $this->expectException(MetaDataException::class);
    $factory = new HeadFactory();
    $factory->fromYamlFile($path);
  }

  public function testHeadFactoringFromYaml(): void {
    $factory = new HeadFactory;
    $this->expectException(MetaDataException::class);
    $head = $factory->fromYamlFile('./sphp/php/tests/metadata/meta-data.yml');
    $data = $this->data();
    foreach ($head as $meta) {
      next($data);
      //var_dump( $meta, current($data));

      $this->assertInstanceOf(\Sphp\Html\Head\MetaData::class, $meta);
    }
  }

  public function testLinkData(): void {
    $factory = new HeadFactory;
    $head1 = $factory->fromYamlFile('./sphp/php/tests/metadata/link/short.yml');
    $head2 = $factory->fromYamlFile('./sphp/php/tests/metadata/link/long.yml');
    $this->assertEquals($head2, $head1);
    foreach ($head1 as $meta) {
      $this->assertInstanceOf(ImmutableLinkData::class, $meta);
    }
  }

  public function metaFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/meta/short.yml'];
    $data[] = ['./sphp/php/tests/metadata/meta/default.yml'];
    return $data;
  }

  public function testMetaData(): void {
    $factory = new HeadFactory;
    $head1 = $factory->fromYamlFile('./sphp/php/tests/metadata/meta/short.yml');
    $head2 = $factory->fromYamlFile('./sphp/php/tests/metadata/meta/default.yml');
    $this->assertEquals($head2, $head1);
    foreach ($head1 as $meta) {
      $this->assertInstanceOf(\Sphp\Html\Head\ImmutableMeta::class, $meta);
      //print_r($meta->toArray());
    }
  }

  public function invalidMetaYamlFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/meta/invalid/1.yml'];
    $data[] = ['./sphp/php/tests/metadata/meta/invalid/2.yml'];
    return $data;
  }

  /**
   * @dataProvider invalidMetaYamlFiles
   * 
   * @param  string $path
   * @return void
   */
  public function testInvalidMetaYaml(string $path): void {
    $this->expectException(MetaDataException::class);
    $factory = new HeadFactory();
    $factory->fromYamlFile($path);
  }

  public function baseYamlFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/base/short.yml'];
    $data[] = ['./sphp/php/tests/metadata/base/default.yml'];
    return $data;
  }

  /**
   * @dataProvider baseYamlFiles
   * 
   * @param string $path
   * @return void
   */
  public function testBase(string $path): void {
    $y = new \Sphp\Stdlib\Parsers\Yaml();
    $raw = $y->fileToArray('./sphp/php/tests/metadata/base/default.yml');
    //print_r($raw);
    $factory = new HeadFactory;
    $head = $factory->fromYamlFile($path);
    $this->assertCount(1, $head);
    foreach ($head as $meta) {
      $this->assertInstanceOf(Base::class, $meta);
      $this->assertEqualsCanonicalizing($raw[0]['base'], $meta->toArray());
    }
  }

  public function invalidBaseDataFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/base/invalid/1.yml'];
    $data[] = ['./sphp/php/tests/metadata/base/invalid/1.yml'];
    return $data;
  }

  /**
   * @dataProvider invalidBaseDataFiles
   * 
   * @param string $path
   * @return void
   */
  public function testInvalidBaseData(string $path): void {
    $this->expectException(MetaDataException::class);
    $factory = new HeadFactory();
    $factory->fromYamlFile($path);
  }

  public function titleFiles(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/metadata/title/default.yml'];
    return $data;
  }

  /**
   * @dataProvider titleFiles
   * 
   * @param string $path
   * @return void
   */
  public function testTitle(string $path): void {
    $y = new \Sphp\Stdlib\Parsers\Yaml();
    $raw = $y->fileToArray('./sphp/php/tests/metadata/title/default.yml');
    //print_r($raw);
    $factory = new HeadFactory;
    $head = $factory->fromYamlFile($path);
    $this->assertCount(1, $head);
    foreach ($head as $meta) {
      $this->assertInstanceOf(Title::class, $meta);
      $this->assertEqualsCanonicalizing($raw[0], $meta->toArray());
    }
  }

}
