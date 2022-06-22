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
use Sphp\Html\Forms\Inputs\TextInput;

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
    yield [new TextInput(), null,];
    yield [new TextInput(), new Legend('legend content'),];
    yield ['legend content', null];
    yield [null, 'legend content'];
    yield [null, new Legend('legend content')];
  }

  /**
   * @dataProvider constructorDataProvider
   * 
   * @param  mixed $content
   * @param  string|Legend|null $legend
   * @return void
   */
  public function testConstructorWithParams(mixed $content, string|Legend|null $legend): void {
    $fieldset = new Fieldset($content, $legend);
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
