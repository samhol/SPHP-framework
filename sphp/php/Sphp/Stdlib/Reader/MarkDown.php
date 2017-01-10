<?php

/**
 * Markdown.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Reader;

use Exception;
use RuntimeException;
use ParsedownExtraPlugin;

/**
 * Markdown reader
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Markdown extends AbstractReader {

  /**
   * fromString(): defined by Reader interface.
   *
   * @param  string $string
   * @return array|bool
   * @throws RuntimeException
   */
  public function fromString($string) {
    try {
      $data = ParsedownExtraPlugin::instance()->text($string);
    } catch (Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $data;
  }

}
