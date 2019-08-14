<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

/**
 * Description of InvalidStringToArrayTestTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait InvalidStringToArrayTestTrait {

  abstract public function buildArrayParser(): ArrayParser;

  abstract public function invalidRawStrings(): array;

  /**
   * @dataProvider invalidRawStrings
   * @param  string $string
   * @return void
   */
  public function testInvalidStringToArray(string $string): void {
    $writer = $this->buildArrayParser();

    $this->expectException(\Exception::class);

    $writer->stringToArray($string);
  }

}
