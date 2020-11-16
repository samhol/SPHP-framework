<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use Sphp\Html\TraversableContent;
use Sphp\Html\Span;
use Sphp\Html\Div;

/**
 * Trait TraversableContentTestTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait TraversableContentTestTrait {

  public function traversableContent(): iterable {
    $data = [];
    $data[2] = new Span('foo');
    $data[1] = $div = new Div('foo');
    $data[0] = new Div($div);
    $data['foo'] = 'string';
    $data[] = null;
    $data[] = 2;
    $data[100] = false;
    return $data;
  }

  /**
   * @return TraversableContent
   */
  abstract public function create(iterable $content): TraversableContent;

  /**
   * @return void
   */
  public function testGetComponentsBy(): void {
    $it = $this->create($this->traversableContent());
    $divs = $it->getComponentsBy(function ($value): bool {
      return $value instanceof Div;
    });
    $divs1 = $it->getComponentsByObjectType(Div::class);
    $this->assertContainsOnly(Div::class, $divs);
    $this->assertEquals($divs1, $divs);
    $strings = $it->getComponentsBy(function ($value): bool {
      return is_string($value);
    });
    foreach ($strings as $string) {
      $this->assertIsString($string);
    }
  }

  public function testToArray(): void {
    $data = $this->traversableContent();
    $it = $this->create($data);
    $this->assertSame($data, $it->toArray());
  }

  public function testCount(): void {
    $data = $this->traversableContent();
    $it = $this->create($data);
    $this->assertCount(count($data), $it);
    $this->assertSame(count($it), $it->count());
  }

}
