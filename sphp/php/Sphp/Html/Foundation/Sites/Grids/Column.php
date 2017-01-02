<?php

/**
 * Column.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

/**
 * Implements Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Column extends Div implements ColumnInterface {

  use ColumnTrait;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a string.
   * So also an object of any class that implements magic method `__toString()` 
   * is allowed.
   *
   * @param  mixed $content the content of the column
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   */
  public function __construct($content = null, $s = 12, $m = false, $l = false, $xl = false, $xxl = false) {
    parent::__construct($content);
    $this->cssClasses()->lock('columns');
    $widthSetter = function ($width, $sreenSize) {
      if ($width > 0 && $width < 13) {
        $this->cssClasses()->add("$sreenSize-$width");
      }
    };
    $widthSetter($s, 'small');
    $widthSetter($m, 'medium');
    $widthSetter($l, 'large');
    $widthSetter($xl, 'xlarge');
    $widthSetter($xxl, 'xxlarge');
  }

}
