<?php

/**
 * FormRow.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Foundation\F6\Core\AbstractRow as AbstractRow;
use Sphp\Html\Foundation\F6\Core\ColumnInterface as ColumnInterface;
use Sphp\Html\Forms\InputInterface as InputInterface;

/**
 * Class extends a Foundation Row for form components
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormRow extends AbstractRow {

  /**
   * Appends a single {@link ColumnInterface} component to the row
   *
   * **Important:**
   *
   * * `$content` can be of any type that converts to a `string` or to a `string[]`
   * * if the `$content` implements {@link InputInterface} it gets wrapped with 
   *   {@link InputColumn} component
   *
   * @param  mixed|mixed[] $content column content
   * @param  int $small column width for small screens
   * @param  int $medium column width for medium screens
   * @param  int $large column width for large screens
   * @return self for PHP Method Chaining
   */
  public function appendColumn($content, $small = 12, $medium = null, $large = null) {
    //echo "<pre>";
    //var_dump($content);
    if ($content instanceof InputInterface) {
      $this->append(new InputColumn($content, $small, $medium, $large));
    } else {
      parent::appendColumn($content, $small, $medium, $large);
    }
    return $this;
  }

  /**
   * Returns the input content as an array of {@link Column} components
   *
   * **Notes:**
   * 
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of $columns not extending {@link Column} are wrapped with {@link Column} object
   * 
   * @param  mixed|mixed[] $columns content components
   * @return ColumnInterface[] wrapped content component(s) in an array
   
  protected function parseContentToColumns($columns) {
    $wrapToCol = function($c) {
      if ($c instanceof ColumnInterface) {
        return $c;
      } else if ($c instanceof InputInterface) {
        return new InputColumn($c);
      } else {
        return new \Sphp\Html\Foundation\Grids\Column($c);
      }
    };

    if (!is_array($columns)) {
      return [$wrapToCol($columns)];
    } else {
      $res = [];
      foreach ($columns as $c) {
        $res[] = $wrapToCol($c);
      }
      return $res;
    }
  }
   */

}
