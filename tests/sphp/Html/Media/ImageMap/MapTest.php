<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;

class MapTest extends TestCase {

  /**
   * @return Map
   */
  public function testConstructor(): Map {
    $map = new Map();
    $this->assertSame('', $map->getName());
    $this->assertSame($map, $map->setName('foo-map'));
    $this->assertSame('foo-map', $map->getName());
    return $map;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Map $map
   * @return Map
   */
  public function testAppend(Map $map): Map {
    $polygon = new Polygon([2, 3, 4, 5]);
    $circle = new Circle(20, 20, 10, 'foo.html', 'This is Foo');
    $this->assertFalse($map->containsArea($polygon));
    $map->append($polygon);
    $this->assertTrue($map->containsArea($polygon));
    $this->assertCount(1, $map);
    $map->append($circle);
    $this->assertTrue($map->containsArea($circle));
    $p = $map->appendPolygon([10, 10, 30, 40]);
    $this->assertTrue($map->containsArea($p));
    //$this->assertSame($map, $map->appendPolygon([2,4,100,100]));
    return $map;
  }

}
