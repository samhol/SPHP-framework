<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\Param;

/**
 * Class ParamTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ParamTest extends TestCase {

  public function parameters(): array {
    $data = [];
    $data[] = ['foo', 'bar'];
    $data[] = ['foo', 1];
    $data[] = ['foo', null]; 
    return $data;
  }

  /**
   * @dataProvider parameters
   * 
   * @param  string $name
   * @param  string $value
   * @return void
   */
  public function testConstructor(string $name, $value): void {
    $param = new Param($name, $value);
    $this->assertSame($name, $param->getName());
    $this->assertSame($name, $param->getAttribute('name'));
    $this->assertSame($value, $param->getValue());
    $this->assertSame($value, $param->getAttribute('value'));
    $this->assertSame("<{$param->getTagName()} {$param->attributes()}>", $param->getHtml());
  }

}
