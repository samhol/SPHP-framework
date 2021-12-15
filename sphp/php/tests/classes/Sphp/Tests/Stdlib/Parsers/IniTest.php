<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

use Sphp\Stdlib\Parsers\ArrayParser;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\Ini;

/**
 * Description of JsonTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IniTest extends AbstractParserTest {

  /**
   * @dataProvider invalidRawStrings
   * 
   * @param  string $string
   * @return void
   */
  public function testInvalidStringToArray(string $string): void {
    $writer = $this->buildArrayParser();
    $this->expectException(\Exception::class);
    $writer->stringToArray($string);
  }

  public function buildArrayParser(): ArrayParser {
    return new Ini();
  }

  public function validToStringData(): array {
    $map = [
        [['foo' => 'bar'], "foo = \"bar\"\n"],
    ];
    return $map;
  }

  public function validFileToArrayData(): array {
    $map = [
        ['./sphp/php/tests/files/valid.ini', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function invalidRawStrings(): array {
    $data = [];
    $data[] = ['?{}^=d'];
    return $data;
  }

  public function invalidToStringData(): array {
    $data[] = [new \stdClass(), InvalidArgumentException::class];
    return $data;
  }

}
