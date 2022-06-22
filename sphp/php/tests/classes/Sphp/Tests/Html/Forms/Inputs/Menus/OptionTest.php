<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Menus\Option;

/**
 * Class OptionTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class OptionTest extends TestCase {

  public function optionData(): iterable {
    yield ['a', 'b'];
    yield [1, 'foo'];
    yield [1.2, 1];
    yield [' ', null];
    yield [null, 1.2];
  }

  /**
   * @dataProvider optionData
   * 
   * @param  string|int|float|null $value
   * @param  string|int|float|null $content
   * @return void
   */
  public function testConstructor(string|int|float|null $value = null, string|int|float|null $content = null): void {
    $opt = new Option($value, $content);
    $this->assertSame($value, $opt->getValue());
    $this->assertSame($value, $opt->getAttribute('value'));
    $this->assertSame($content, $opt->getContent());
    $this->assertFalse($opt->isSelected());
    $this->assertTrue($opt->isEnabled());
    $this->assertSame($opt, $opt->disable(true));
    $this->assertFalse($opt->isEnabled());
    $this->assertTrue($opt->attributes()->isVisible('disabled'));
    $this->assertSame($opt, $opt->disable(false));
    $this->assertTrue($opt->isEnabled());
    $this->assertFalse($opt->attributes()->isVisible('disabled'));
  }

  public function testEmptyConstructor(): void {
    $opt = new Option( );
    $this->assertNull($opt->getValue());
    $this->assertNull($opt->getAttribute('value'));
    $this->assertFalse($opt->isSelected());
    $this->assertTrue($opt->isEnabled());
  }

  /**
   * @dataProvider optionData
   * 
   * @param  string|int|float|null $value
   * @param  string|int|float|null $content
   * @return void
   */
  public function testOutputs(string|int|float|null $value = null, string|int|float|null $content = null): void {
    $opt = new Option($value, $content);
    $this->assertSame((string) $content, $opt->contentToString());
    $this->assertSame($value, $opt->getAttribute('value'));
  }

  /**
   * @return Option
   */
  public function testSetValue(): Option {
    $opt = new Option('a', 'b');
    $this->assertSame('a', $opt->getValue());
    $this->assertSame($opt, $opt->setValue('foo'));
    $this->assertSame('foo', $opt->getValue());
    $this->assertSame('foo', $opt->getAttribute('value'));
    $this->assertSame('<option ' . $opt->attributes() . '>' . $opt->getContent() . '</option>', (string) $opt);
    return $opt;
  }

  /**
   * @depends testSetValue
   *
   * @param  Option $opt
   * @return Option
   */
  public function testDisable(Option $opt): Option {
    $this->assertTrue($opt->isEnabled());
    $this->assertSame($opt, $opt->disable(true));
    $this->assertFalse($opt->isEnabled());
    $this->assertSame(true, $opt->getAttribute('disabled'));
    $this->assertSame('<option ' . $opt->attributes() . '>' . $opt->getContent() . '</option>', (string) $opt);
    $this->assertSame($opt, $opt->disable(false));
    $this->assertTrue($opt->isEnabled());
    $this->assertSame(false, $opt->getAttribute('disabled'));
    return $opt;
  }

  /**
   * @depends testDisable
   *
   * @param  Option $opt
   * @return Option
   */
  public function testSetSelected(Option $opt): Option {
    $this->assertFalse($opt->isSelected());
    $this->assertFalse($opt->attributeExists('selected'));
    $this->assertSame($opt, $opt->setSelected(true));
    $this->assertTrue($opt->isSelected());
    $this->assertSame(true, $opt->getAttribute('selected'));
    $this->assertSame('<option ' . $opt->attributes() . '>' . $opt->getContent() . '</option>', (string) $opt);
    return $opt;
  }

}
