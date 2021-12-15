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

use Sphp\Stdlib\Parsers\Yaml;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\ArrayParser;

class YamlTest extends AbstractParserTest {

  public function buildArrayParser(): ArrayParser {
    return new Yaml();
  }

  public function invalidToStringData(): array {
    $data[] = [new \stdClass(), InvalidArgumentException::class];
    return $data;
  }

  public function validToStringData(): array {
    $map = [
        [['foo' => 'bar'], "foo: bar\n"],
    ];
    return $map;
  }

  public function validFileToArrayData(): array {
    $map = [
        ['./sphp/php/tests/files/valid.yaml', ['foo' => 'bar']],
    ];
    return $map;
  }

  public function invalidRawStrings(): array {
    $data = [];
    $data[] = ['!php/object \'O:8:"stdClass":1:{s:5:"foo";s:7:"bar";}\''];
    return $data;
  }

  /**
   * @dataProvider invalidRawStrings
   * @param  string $string
   * @param  array $expected
   * @return void
   */
  public function testInvalidStringToArray(string $string): void {
    $writer = new Yaml();
    $this->expectException(\Exception::class);
    $writer->stringToArray($string);
  }

}
