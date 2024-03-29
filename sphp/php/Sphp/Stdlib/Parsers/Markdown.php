<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\FileSystemException;
use ParsedownExtra;
use Sphp\Stdlib\Filesystem;

/**
 * Implements a Markdown converter
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Markdown implements StringConverter {

  public function parseString(string $string, bool $inlineOnly = false): string {
    if ($inlineOnly) {
      $data = ParsedownExtra::instance()->line($string);
    } else {
      $data = ParsedownExtra::instance()->text($string);
    }
    return $data;
  }

  public function parseFile(string $filename, bool $inlineOnly = false): string {
    if (!Filesystem::isFile($filename)) {
      throw new FileSystemException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    return $this->parseString(Filesystem::toString($filename), $inlineOnly);
  }

}
