<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Description of DataOptionToolsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DataOptionToolsTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function toDataAttributeData(): array {
    return [
        ['dataFoo', 'data-data-foo'],
        ['data-data-foo', 'data-data-foo'],
    ];
  }

  /**
   * @covers \Sphp\Html\Foundation\Sites\Core\DataOptionTools::toDataAttribute
   * @dataProvider toDataAttributeData
   *
   * @param string $raw
   * @param string $dataAttrName
   */
  public function testToDataAttribute(string $raw, string $dataAttrName) {
    $this->assertEquals($dataAttrName, DataOptionTools::toDataAttribute($raw));
  }

}
