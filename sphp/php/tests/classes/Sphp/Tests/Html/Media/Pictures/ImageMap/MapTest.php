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
Use Sphp\Html\Media\Pictures\ImageMap\{
  Map,
  Circle,
  Rectangle,
  Polygon,
  Exceptions\MapException
};

class MapTest extends TestCase {

  /**
   * @return Map
   */
  public function testConstructor(): Map {
    $map = new Map('map-name');
    $this->assertSame('map-name', $map->getName());
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
  public function testAppendRectangle(Map $map): Map {
    $expected = new Rectangle(2, 30, 4, 5);
    $this->assertFalse($map->containsArea($expected));
    $polygon = $map->appendRectagle(2, 30, 4, 5);
    $this->assertEquals($expected, $polygon);
    $this->assertTrue($map->containsArea($polygon));
    return $map;
  }

  /**
   * @depends testAppendRectangle
   * 
   * @param  Map $map
   * @return Map
   */
  public function testAppendCircle(Map $map): Map {
    $expected = new Circle(20, 20, 10);
    $this->assertFalse($map->containsArea($expected));
    $circle = $map->appendCircle(20, 20, 10);
    $this->assertTrue($map->containsArea($circle));
    $this->assertEquals($expected, $circle);
    $this->assertContains($circle, $map);
    return $map;
  }

  /**
   * @depends testAppendCircle
   * 
   * @param  Map $map
   * @return Map
   */
  public function testAppendPolygon(Map $map): Map {
    $coords = [20, 20, 10, 40, 5, 7];
    $expected = new Polygon(...$coords);
    $this->assertFalse($map->containsArea($expected));
    $actual = $map->appendPolygon(...$coords);
    $this->assertTrue($map->containsArea($actual));
    $this->assertEquals($expected, $actual);
    $this->assertContains($actual, $map);
    return $map;
  }

  /**
   * @depends testAppendPolygon
   * 
   * @param  Map $map
   * @return Map
   */
  public function testAppend(Map $map): Map {
    $rectangle = new Rectangle(2, 3, 4, 5);
    $map->append($rectangle);
    $this->assertTrue($map->containsArea($rectangle));
    $circle = new Circle(20, 20, 10);
    $map->append($circle);
    $this->assertTrue($map->containsArea($circle));
    $polygon = new Polygon(20, 20, 10, 6, 4, 10);
    $map->append($polygon);
    $this->assertTrue($map->containsArea($polygon));
    return $map;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Map $map
   * @return Map
   */
  public function testAppendSameObjectMultipleTimes(Map $map) {
    $rectangle = new Rectangle(2, 3, 4, 5);
    $map->append($rectangle);
    $this->expectException(MapException::class);
    $map->append($rectangle);
  }

  /**
   * @depends testAppend
   * 
   * @param  Map $map
   * @return Map
   */
  public function testOutput(Map $map): Map {
    $this->assertStringContainsString($map->getIterator()->getHtml(), $map->contentToString());
    $fullTag = "<{$map->getTagName()} {$map->attributes()}>{$map->contentToString()}</{$map->getTagName()}>";
    $this->assertSame($fullTag, $map->getHtml());
    return $map;
  }

}
