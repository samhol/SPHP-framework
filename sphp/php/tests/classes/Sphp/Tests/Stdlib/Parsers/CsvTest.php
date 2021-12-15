<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

use Sphp\Stdlib\Parsers\ArrayParser;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\Csv;

/**
 * Implementation of CsvTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CsvTest extends AbstractParserTest {

  public function buildArrayParser(): ArrayParser {
    return new Csv();
  }

  public function invalidToStringData(): array {
    $data[] = [[new \stdClass()], InvalidArgumentException::class];
    return $data;
  }

  public function validToStringData(): array {
    $map = [];
    $map[] = [[['foo', 'bar']], 'foo,bar' . PHP_EOL];
    return $map;
  }

  public function validFileToArrayData(): array {
    $map = [
        ['./sphp/php/tests/files/valid.csv', [['foo', 'bar']]],
    ];
    return $map;
  }

}
