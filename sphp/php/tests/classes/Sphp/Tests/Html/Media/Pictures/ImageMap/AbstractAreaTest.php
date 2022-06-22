<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures\ImageMap;

use Sphp\Tests\Html\Navigation\AbstractHyperlinkTest;
use Sphp\Html\Navigation\Hyperlink;
use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\ImageMap\AbstractArea;

class AbstractAreaTest extends AbstractHyperlinkTest {

  public function createArea(string $shape, string $coordsPattern = '/^(\d+(,\d+)*)?$/'): AbstractArea {
    $area = $this->getMockForAbstractClass(AbstractArea::class, [$shape, $coordsPattern]);
    return $area;
  }

  public function constructorParams(): array {
    $data = [];
    $data[] = [['foo']];
    $data[] = [['foo', '/^(\d+(,\d+)(,3))?$/']];
    return $data;
  }

  /**
   * @dataProvider constructorParams
   * 
   * @param array $params
   */
  public function testConstructor(array $params) {
    $area = $this->getMockForAbstractClass(AbstractArea::class, $params);
    $this->assertEquals($params[0], $area->getShape());
  }

  public function testDefault(): AbstractArea {
    $area = $this->createArea('foo');
    $this->assertEquals([], $area->getCoordinates());
    return $area;
  }

  /**
   * @depends testDefault
   * 
   * @param AbstractArea $area
   */
  public function testHrefAndAlt(AbstractArea $area) {
    $this->assertNull($area->getHref());
    $this->assertNull($area->getAlt());
    $this->assertSame($area, $area->setHref('/foo'));
    $this->assertSame('/foo', $area->getHref());
    $this->assertSame('/foo', $area->getAlt());
    $this->assertSame($area, $area->setAlt('Alternative text'));
    $this->assertEquals('Alternative text', $area->getAlt());
    $this->assertSame($area, $area->setHref('/bar', 'this is bar'));
    $this->assertSame('/bar', $area->getHref());
    $this->assertSame('this is bar', $area->getAlt());
  }

  public function createHyperlink(): \Sphp\Html\Navigation\Hyperlink {
    $area = $this->getMockForAbstractClass(AbstractArea::class, ['default']);
    return $area;
  }

}
