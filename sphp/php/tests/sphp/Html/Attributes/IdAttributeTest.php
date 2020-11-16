<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\IdAttribute;
use Sphp\Html\Attributes\MutableAttribute;

/**
 * Class IdAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IdAttributeTest extends AbstractScalarAttributeTest {

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
        [''],
        [' '],
        [true],
        [1],
    ];
  }

  public function basicValidValues(): array {
    return [
        ['f1', 'f1'],
        ['foo', 'foo'],
    ];
  }

  public function createAttr(string $name = 'attr'): MutableAttribute {
    return new IdAttribute($name);
  }

  public function outputTestData(): array {
    return [
        ['id', 'foo', 'id="foo"'],
        ['foo', null, ''],
        ['foo', null, ''],
    ];
  }

  /**
   * @dataProvider outputTestData
   *  
   * @param  string $attrName
   * @param  mixed  $value
   * @param  string $expected
   * @return void
   */
  public function testOutput(string $attrName, $value, string $expected): void {
    $attr = new IdAttribute($attrName, $value);
    $this->assertSame($expected, (string) $attr);
  }

}
