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
use Sphp\Html\Forms\Inputs\EmailInput;

/**
 * The EmailInputTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EmailInputTest extends TestCase {

  public function constructorData(): iterable {
    yield ['email', 'mail@example.com'];
    yield ['email', null];
    yield [null, 'mail@example.com, mail2@example.com, mail3@example.com'];
    yield [null, null];
  }

  /**
   * @dataProvider constructorData
   *  
   * @param  string|null $name
   * @param  string|int|float|null $value
   * @return void
   */
  public function testMultiple(?string $name, string|int|float|null $value): void {
    $input = new EmailInput($name, $value);
    $this->assertSame($name !== null, $input->isNamed());
    $this->assertSame($name, $input->getName());
    $this->assertEquals($value, $input->getSubmitValue());
    $this->assertFalse($input->attributeExists('multiple'));
    $this->assertSame($input, $input->multiple(true));
    $this->assertTrue($input->attributeExists('multiple'));
  }

}
