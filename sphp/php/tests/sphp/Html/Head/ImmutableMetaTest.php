<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\ImmutableMeta;
use Sphp\Html\Head\Exceptions\MetaDataException;

/**
 * Class ImmutableMeta Test
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ImmutableMetaTest extends TestCase {

  public function validMetaData(): array {
    $data = [];
    $data[] = [['name' => 'keywords', 'content' => 'bar,baz']];
    $data[] = [['http-equiv' => 'foo', 'content' => 'bar']];
    $data[] = [['charset' => 'UTF-8']];
    $data[] = [['property' => 'foo', 'content' => 'bar']];
    return $data;
  }

  /**
   * @dataProvider validMetaData
   * 
   * @param string[] $data
   * @return void
   */
  public function testConstructor(array $data): void {
    $meta = new ImmutableMeta($data);
    $this->assertEquals($data, $meta->toArray());
  }

  public function invalidMetaData(): array {
    $data = [];
    $data[] = [[]];
    $data[] = [['name' => 'a', 'content' => 'a', 'http-equiv' => 'a']];
    $data[] = [['charset' => 'a', 'property' => 'a']];
    $data[] = [['property' => 'a', 'content' => 'a', 'charset' => 'a']];
    return $data;
  }

  /**
   * @dataProvider invalidMetaData
   * 
   * @param string[] $data
   * @return void
   */
  public function testInvalidConstructorCalls(array $data): void {
    $this->expectException(MetaDataException::class);
    print_r(new ImmutableMeta($data));
  }

  public function overlappingMetaData(): array {
    $data = [];
    $data[] = [['name' => 'a', 'content' => 'a'], ['name' => 'a', 'content' => 'b'], true];
    $data[] = [['http-equiv' => 'a', 'content' => 'a'], ['http-equiv' => 'a', 'content' => 'b'], true];
    $data[] = [['charset' => 'UTF-8'], ['charset' => 'UTF-16'], true];
    $data[] = [['property' => 'a', 'content' => 'a'], ['property' => 'a', 'content' => 'b'], true];
    $data[] = [['property' => 'a', 'content' => 'a'], ['name' => 'a', 'content' => 'a'], false];
    $data[] = [['property' => 'a', 'content' => 'a'], ['charset' => 'a'], false];
    $data[] = [['property' => 'a', 'content' => 'b'], ['http-equiv' => 'a', 'content' => 'b'], false];
    return $data;
  }

  /**
   * @dataProvider overlappingMetaData
   * 
   * @param  array $set1
   * @param  array $set2
   * @param  bool $isOverlapping
   * @return void
   */
  public function testOverLapping(array $set1, array $set2, bool $isOverlapping): void {
    $link1 = new ImmutableMeta($set1);
    $link2 = new ImmutableMeta($set2);
    if ($isOverlapping) {
      $this->assertSame($link1->getHash(), $link2->getHash());
    } else {
      $this->assertNotSame($link1->getHash(), $link2->getHash());
    }
  }

  /**
   * @dataProvider validMetaData
   * 
   * @param array $data
   * @return void
   */
  public function testOutput(array $data): void {
    $obj1 = new ImmutableMeta($data);
    $obj2 = new ImmutableMeta($data);
    $this->assertSame((string) $obj1->toTag(), (string) $obj2);
  }

}
