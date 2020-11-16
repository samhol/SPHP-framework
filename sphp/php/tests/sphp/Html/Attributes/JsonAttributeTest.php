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

use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\JsonAttribute;

/**
 * Class JsonAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class JsonAttributeTest extends AbstractScalarAttributeTest {

  public function basicInvalidValues(): array {
    $data = [];
    $data[] = ['{"foo":"bar}'];
    return $data;
  }

  public function basicValidValues(): array {
    $data = [];
    $data[] = ['{"foo":"bar"}', '{"foo":"bar"}'];
    $data[] = [['foo' => 'bar'], '{"foo":"bar"}'];
    $obj = new \stdClass();
    $obj->foo = 'bar';
    $data[] = [$obj, '{"foo":"bar"}'];
    return $data;
  }

  public function createAttr(string $name = 'attr'): MutableAttribute {
    return new JsonAttribute($name);
  }

  /**
   * @dataProvider basicValidValues
   * 
   * @param  mixed $value
   * @param  string $output
   * @return void
   */
  public function testOutput($value, string $output): void {
    $attr = new JsonAttribute('data-json', $value);
    $this->assertSame($output, $attr->getValue());
    $this->assertSame($attr->getName() . "='$output'", (string) $attr);
  }

  /**
   * @return void
   */
  public function testClear(): void {
    $attr = new JsonAttribute('data-json', ['a' => 0]);
    $attr->clear();
    $this->assertNull($attr->getValue());
  }

}
