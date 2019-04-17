<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class VariableFilterTest extends TestCase {

  public function intData(): array {
    return [
        [1, 1],
        ['00', 0],
        [6.3, 6],
        [6.5, 7],
        [123, 0],
        ['-123', 0],
        ['-10', -10],
        ['-10', -10],
        ['0Xf', 15],
        ['-0Xf', 0],
    ];
  }

  /**
   * @dataProvider intData
   * @param scalar $var
   * @param int $expected
   */
  public function t1estIntFilter($var, int $expected) {
    $intFilter = Filters::int();
    $intFilter->options->min_range = -20;
    $intFilter->options['max_range'] = 20;
    $intFilter->options->default = 0;
    $this->assertSame(0, $intFilter->flags);
    $intFilter->flags = FILTER_FLAG_ALLOW_HEX;
    $this->assertSame(FILTER_FLAG_ALLOW_HEX, $intFilter->getFlags());
    $this->assertSame(FILTER_FLAG_ALLOW_HEX, $intFilter->flags);
    $this->assertSame($expected, $intFilter($var));
  }

  public function testFactoryFail() {
    $this->expectException(BadMethodCallException::class);
    Filters::foo();
  }

  public function testSettingsGettingFail() {
    $this->expectException(InvalidArgumentException::class);
    $filter = Filters::string();
    echo $filter->foo;
  }

  public function testSettingsSettingFail() {
    $this->expectException(InvalidArgumentException::class);
    $filter = Filters::string();
    $filter->foo = 'bar';
  }

  public function validFilters() {
    $ids = [];
    foreach (filter_list() as $filter) {
      $ids[] = [$filter, filter_id($filter)];
    }
    return $ids;
  }

  /**
   * @dataProvider validFilters
   * @param int $id
   */
  public function testFilterFactory(string $name, int $id) {
    $factortVersion = Filters::$name();
    $filter = new VariableFilter($id);
    $this->assertSame($id, $factortVersion->getFilter());
    $this->assertSame($id, $filter->getFilter());
  }

}
