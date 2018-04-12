<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;
use Sphp\Html\Span;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
