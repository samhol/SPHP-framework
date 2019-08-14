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
class IniTest extends AbstractParserTest {

  use \Sphp\Tests\Stdlib\Parsers\InvalidStringToArrayTestTrait;

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
