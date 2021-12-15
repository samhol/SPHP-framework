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
use Sphp\Html\Media\ImageMap\Circle;
use Sphp\Html\Media\ImageMap\Exceptions\CoordinateException;

/**
 * Class CircleTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CircleTest extends TestCase {

  public function testEmptyConstructor(): Circle {
    $rect = new Circle();
    $this->assertSame([0, 0, 0], $rect->getCoordinates());
    $this->assertNull($rect->getHref());
    $this->assertNull($rect->getRelationship());
    $this->assertSame('circle', $rect->getShape());
    return $rect;
  }

  public function invalidCoordinates(): array {
    $data = [];
    $data[] = [1];
    $data[] = range(1, 2);
    $data[] = range(1, 4);
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
    $rectangle = new Circle();
    $rectangle->setCoordinates(...$coords);
  }

}
