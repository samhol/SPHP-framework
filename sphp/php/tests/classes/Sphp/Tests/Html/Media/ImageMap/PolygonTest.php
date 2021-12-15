<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\ImageMap\Polygon;
use Sphp\Html\Media\ImageMap\Exceptions\CoordinateException;

/**
 * Class PolygonTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PolygonTest extends TestCase {

  public function testEmptyConstructor(): Polygon {
    $rect = new Polygon();
    $this->assertSame([], $rect->getCoordinates());
    $this->assertNull($rect->getHref());
    $this->assertNull($rect->getRelationship());
    $this->assertSame('poly', $rect->getShape());
    return $rect;
  }

  public function validCoordinates(): array {
    $data = [];
    $data[] = [1, 2];
    $data[] = range(1, 6);
    return $data;
  }

  /**
   * @dataProvider validCoordinates
   * 
   * @param  int $coords
   * @return void
   */
  public function testConstructor(int...$coords): void {
    $rect = new Polygon(...$coords);
    $this->assertSame($coords, $rect->getCoordinates());
    $this->assertSame('poly', $rect->getShape());
  }

  /**
   * @return void
   */
  public function testAppendEdge(): void {
    $polygon = new Polygon(1, 2);
    $this->assertSame([1, 2], $polygon->getCoordinates());
    $this->assertSame($polygon, $polygon->appendEdge(10, 20));
    $this->assertSame([1, 2, 10, 20], $polygon->getCoordinates());
  }

  public function invalidCoordinates(): array {
    $data = [];
    $data[] = [1];
    $data[] = range(1, 3);
    return $data;
  }

  /**
   * @dataProvider invalidCoordinates
   * 
   * @param  int $coords
   * @return void
   */
  public function testInvalidConstructor(int...$coords): void {
    $this->expectException(CoordinateException::class);
    new Polygon(...$coords);
  }

  /**
   * @dataProvider invalidCoordinates
   * 
   * @param  int $coords
   * @return void
   */
  public function testInvalidCoordinatesSetting(int...$coords): void {
    $this->expectException(CoordinateException::class);
    $palygon = new Polygon();
    $palygon->setCoordinates(...$coords);
  }

}
