<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\Assert;
use Sphp\Html\TraversableContent;
use Sphp\Html\Text\Span;
use Sphp\Html\Layout\Div;

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
   * @return TraversableContent
   */
  public function testGetComponentsBy(): TraversableContent {
    $it = $this->create($this->traversableContent());
    $divs = $it->getComponentsBy(function ($value): bool {
      return $value instanceof Div;
    });
    $divs1 = $it->getComponentsByObjectType(Div::class);
    Assert::assertContainsOnly(Div::class, $divs);
    Assert::assertEquals($divs1, $divs);
    $strings = $it->getComponentsBy(function ($value): bool {
      return is_string($value);
    });
    foreach ($strings as $string) {
      Assert::assertIsString($string);
    }
    return $it;
  }

  /**
   * @depends testGetComponentsBy
   * 
   * @param TraversableContent $it
   * @return void
   */
  public function testToArrayAndCount(TraversableContent $it): void {
    $content = $this->traversableContent();
    Assert::assertEquals($content, $it->toArray());
    $count = count($content);
    Assert::assertCount($count, $it);
    Assert::assertSame($count, $it->count());
    Assert::assertSame($count, count($it));
    Assert::assertCount(0, $this->create([]));
  }

}
