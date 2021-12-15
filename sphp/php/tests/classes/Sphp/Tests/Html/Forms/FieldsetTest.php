<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Fieldset;
use Sphp\Html\Forms\Legend;

/**
 * Class FieldsetTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FieldsetTest extends TestCase {

  public function testEmptyConstructor(): void {
    $fieldset = new Fieldset();
    $this->assertNull($fieldset->getLegend());
    $this->assertEmpty($fieldset->getIterator());
    $this->assertTrue($fieldset->isEnabled());
    $this->assertSame('', $fieldset->contentToString());
  }

  public function constructorDataProvider(): iterable {
    yield [null, new \Sphp\Html\Forms\Inputs\TextInput()];
    yield ['foo', new \Sphp\Html\Forms\Inputs\TextInput()];
    yield ['foo', null];
    yield ['foo', null];
  }

  /**
   * @dataProvider constructorDataProvider
   * 
   * @param  mixed $legend
   * @param  mixed $content
   * @return void
   */
  public function testConstructorWithParams($legend, $content): void {
    $fieldset = new Fieldset($legend, $content);
    if ($legend === null) {
      $this->assertNull($fieldset->getLegend());
    } else if ($legend instanceof Legend) {
      $this->assertSame($legend, $fieldset->getLegend());
    } else {
      $this->assertEquals(new Legend($legend), $fieldset->getLegend());
    }
    if ($content !== null) {
      $this->assertNotEmpty($fieldset->getIterator());
    } else {
      $this->assertEmpty($fieldset->getIterator());
    }
    $this->assertTrue($fieldset->isEnabled());
  }

  public function testDisabling(): void {
    $fieldset = new Fieldset('foo', 'bar');
    $this->assertTrue($fieldset->isEnabled());
    $this->assertSame($fieldset, $fieldset->disable(true));
    $this->assertFalse($fieldset->isEnabled());
    $this->assertSame($fieldset, $fieldset->disable(false));
    $this->assertTrue($fieldset->isEnabled());
  }

}
