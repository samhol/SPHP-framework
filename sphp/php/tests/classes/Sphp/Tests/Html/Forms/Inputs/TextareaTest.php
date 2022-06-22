<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Textarea;
use Sphp\Html\Exceptions\HtmlException;

/**
 * The TextareaTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TextareaTest extends TestCase {

  public function constructorData(): iterable {
    yield ['textarea', '1'];
    yield ['', '1.2'];
    yield ['textarea', 1];
    yield [' ', null];
    yield [null, 1.2];
  }

  /**
   * @dataProvider constructorData
   *  
   * @param  string|null $name
   * @param  string|int|float|null $value
   * @return void
   */
  public function testConstructor(?string $name, string|int|float|null $value): void {
    $input = new Textarea($name, $value);
    $this->assertSame($name !== null, $input->isNamed());
    $this->assertSame($name, $input->getName());
    $this->assertEquals($value, $input->getSubmitValue());
    $this->assertTrue($input->isEnabled());
    $this->assertFalse($input->isRequired());
  }

  public function testSetRequired(): void {
    $input = new Textarea('textarea-input', 'foo bar');
    $this->assertFalse($input->isRequired());
    $this->assertSame($input, $input->setRequired(true));
    $this->assertTrue($input->isRequired());
  }

  public function testSetPlaceholder(): void {
    $input = new Textarea('textarea-input', 'foo bar');
    $this->assertFalse($input->attributeExists('placeholder'));
    $this->assertSame($input, $input->setPlaceholder('text'));
    $this->assertSame('text', $input->getAttribute('placeholder'));
    $this->assertSame($input, $input->setPlaceholder(null));
    $this->assertFalse($input->attributeExists('placeholder'));
  }

  public function testSetCols(): void {
    $input = new Textarea('textarea-input', 'foo bar');
    $this->assertFalse($input->attributeExists('cols'));
    $this->assertSame($input, $input->setCols(2));
    $this->assertSame(2, $input->getAttribute('cols'));
    $this->assertSame($input, $input->setCols(null));
    $this->assertFalse($input->attributeExists('cols'));
    $this->expectException(HtmlException::class);
    $this->assertSame($input, $input->setCols(0));
  }

  public function testSetRows(): void {
    $input = new Textarea('textarea-input', 'foo bar');
    $this->assertFalse($input->attributeExists('rows'));
    $this->assertSame($input, $input->setRows(2));
    $this->assertSame(2, $input->getAttribute('rows'));
    $this->assertSame($input, $input->setRows(null));
    $this->assertFalse($input->attributeExists('rows'));
    $this->expectException(HtmlException::class);
    $this->assertSame($input, $input->setRows(0));
  }

}
