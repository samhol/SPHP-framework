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

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\ImmutableAttribute;

class ImmutabeAttributeTest extends TestCase {

  /**
   * @return array[]
   */
  public function constructionData(): array {
    $data = [];
    $data[] = ['foo', 'bar'];
    $data[] = ['foo', 0];
    $data[] = ['foo', true];
    $data[] = ['foo', false];
    return $data;
  }

  /**
   * @dataProvider constructionData
   * 
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function testConstructor(string $name, $value): void {
    $attr = new ImmutableAttribute($name, $value);
    $this->assertTrue($attr->isProtected());
    $this->assertEquals($attr->getValue(), $value);
    if ($value === false) {
      $this->assertFalse($attr->isVisible());
    } else {
      $this->assertTrue($attr->isVisible());
    }
  }

  public function basicValidValues(): array {
    $data = [];
    $data[] = [1, '%s="%s"'];
    $data[] = [true, '%s'];
    $data[] = [false, ''];
    return $data;
  }

  /**
   * @dataProvider basicValidValues
   * 
   * @param  type $value
   * @param  type $output
   * @return void
   */
  public function testOutput($value, $output): void {
    $attr = new ImmutableAttribute('data-json', $value);
    $this->assertSame($value, $attr->getValue());
    $this->assertSame(sprintf($output, 'data-json', $value), (string) $attr);
  }

  /**
   * @return array[]
   */
  public function isEmptyData(): array {
    $data = [];
    $data[] = ['foo', false];
    $data[] = [0, false];
    $data[] = [false, true];
    $data[] = [true, true];
    $data[] = [null, true];
    $data[] = ['', true];
    return $data;
  }

  /**
   * @dataProvider isEmptyData
   * 
   * @param  scalar $value
   * @param  bool $isEmpty
   * @return void
   */
  public function testIsEmpty($value, bool $isEmpty): void {
    $attr = new ImmutableAttribute('data-immutable', $value);
    $this->assertSame($value, $attr->getValue());
    $this->assertSame($isEmpty, $attr->isEmpty());
    $this->assertTrue($attr->isProtected());
    if ($attr->isVisible()) {
      if ($attr->isEmpty()) {
        $this->assertSame('data-immutable', (string) $attr);
      } else {
        $this->assertSame("data-immutable=\"$value\"", (string) $attr);
      }
    } else {
      $this->assertSame('', (string) $attr);
    }
  }

}
