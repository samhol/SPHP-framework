<?php

/**
 * FaIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;
use Sphp\Html\Span;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Factory {

  /**
   * 
   * @param  string $text
   * @return Span
   */
  public static function screenReaderLabel(string $text = null): Span {
    $label = new Span($text);
    $label->cssClasses()->protect('show-for-sr');
    return $label;
  }

}
