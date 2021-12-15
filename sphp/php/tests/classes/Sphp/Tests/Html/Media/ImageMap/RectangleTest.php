<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\ImageMap\Rectangle;
use Sphp\Html\Media\ImageMap\Exceptions\CoordinateException;

class RectangleTest extends TestCase {

  public function testEmptyConstructor(): Rectangle {
    $rect = new Rectangle();
    $this->assertSame([0, 0, 0, 0], $rect->getCoordinates());
    $this->assertNull($rect->getHref());
    $this->assertNull($rect->getRelationship());
    $this->assertSame('rect', $rect->getShape());
    return $rect;
  }

  public function invalidCoordinates(): array {
    $data = [];
    $data[] = [1];
    $data[] = range(1, 2);
    $data[] = range(1, 3);
    $data[] = range(1, 5);
    return $data;
  }


  /**
   * @dataProvider invalidCoordinates
   * 
   * @param  int $coords
   * @return void
   */
  public function testInvalidCoordinatesSetting(int...$coords): void {
    $this->expectException(CoordinateException::class);
    $rectangle = new Rectangle();
    $rectangle->setCoordinates(...$coords);
  }

}
