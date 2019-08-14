<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of JsonTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class JsonTest extends AbstractParserTest {

  public function buildArrayParser(): ArrayParser {
    return new Json();
  }

  public function invalidToStringData(): array {
    $data = [];
    $data[] = [["fail" => "\xB1\x31"], InvalidArgumentException::class];
    return $data;
  }

  public function validToStringData(): array {
    $data = [];
    $data[] = [
        ['foo', 'bar', 'baz', 'blong'],
        '{"0":"foo","1":"bar","2":"baz","3":"blong"}'
    ];
    return $data;
  }

  public function validFileToArrayData(): array {
    $map = [
        ['./sphp/php/tests/files/valid.json', ['foo' => 'bar']],
    ];
    return $map;
  }

}
