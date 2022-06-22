<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures\ImageMap;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\ImageMap\{
  Rectangle,
  Exceptions\CoordinateException
};

class RectangleTest extends TestCase {

  public function coordinatesData(): iterable {
    yield [1, 2, 3, 4];
  }

  /**
   * @dataProvider coordinatesData
   * 
   * @param  int $x1
   * @param  int $y1
   * @param  int $x2
   * @param  int $y2
   * @return void
   */
  public function testConstructorAndCoordinates(int $x1, int $y1, int $x2, int $y2): void {
    $rect = new Rectangle($x1, $y1, $x2, $y2);
    $rect1 = new Rectangle(0, 0, 0, 0);
    $rect1->setCoordinates($x1, $y1, $x2, $y2);
    $this->assertEquals($rect, $rect1);
    $this->assertSame([$x1, $y1, $x2, $y2], $rect->getCoordinates());
    $this->assertNull($rect->getHref());
    $this->assertNull($rect->getRelationship());
    $this->assertSame('rect', $rect->getShape());
  }

  public function invalidCoordinates(): array {
    $data = [];
    $data[] = [-1, -2, -1, -1];
    $data[] = [1, 2, 1, -1];
    return $data;
  }

  /**
   * @dataProvider invalidCoordinates
   * 
   * @param  int $x1
   * @param  int $y1
   * @param  int $x2
   * @param  int $y2
   * @return void
   */
  public function testInvalidCoordinatesSetting(int $x1, int $y1, int $x2, int $y2): void {
    $this->expectException(CoordinateException::class);
    new Rectangle($x1, $y1, $x2, $y2);
  }

}
