<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core\DataOptions;

class DataOptionToolsTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function toDataAttributeData(): array {
    return [
        ['dataFoo', 'data-foo'],
        ['data-data-foo', 'data-data-foo'],
        ['data2', 'data-data2'],
        ['isFoo', 'data-is-foo'],
    ];
  }

  /**
   * @covers \Sphp\Html\Foundation\Sites\Core\DataOptions\DataOptionTools::toDataAttribute
   * @dataProvider toDataAttributeData
   *
   * @param string $raw
   * @param string $dataAttrName
   */
  public function testToDataAttribute(string $raw, string $dataAttrName) {
    $this->assertEquals($dataAttrName, DataOptionTools::toDataAttribute($raw));
  }

  /**
   * @return array
   */
  public function toOptionNameData(): array {
    return [
        ['data-foo', 'foo'],
        ['data-data-foo', 'dataFoo'],
        ['data-1', '1'],
    ];
  }

  /**
   * @covers \Sphp\Html\Foundation\Sites\Core\DataOptions\DataOptionTools::toDataAttribute
   * @dataProvider toOptionNameData
   *
   * @param string $raw
   * @param string $dataAttrName
   */
  public function testToOptionName(string $raw, string $dataAttrName) {
    $this->assertEquals($dataAttrName, DataOptionTools::toOptionName($raw));
  }

}
