<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;

/**
 * Class implements a Foundation row
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-27
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractRow extends AbstractContainerTag implements RowInterface {

  /**
   * Constructs a new instance
   *
   * **Important:**
   *
   * Calculates the widths of the individual {@link ColumnInterface} components by dividing the Row width
   *  with the number of the inserted columns.
   *
   * if the number ofthe columns exceed the maximum width of the row, in most
   *  browser environments the excessive columns are floated to a new 'row'.
   * **HOWEVER** this behaviour is not actively supported.
   *
   * **Notes:**
   * 
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * * The widths of the `mixed $columns` extending {@link ColumnInterface} are kept
   * * The sum of the {@link ColumnInterface} widths in a {@link self} should not exeed 12.
   * 
   * @param  mixed|mixed[] $columns row columns
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($columns = null) {
    $wrapToCol = function($c) {
      if ($c instanceof ColumnInterface) {
        return $c;
      } else {
        return new Column($c);
      }
    };
    parent::__construct("div", null, new \Sphp\Html\WrappingContainer($wrapToCol));
    if ($columns !== null) {
      $this->setColumns($columns);
    }
    $this->cssClasses()->lock("row");
  }

  /**
   * {@inheritdoc}
   */
  public function setColumns($columns) {
    if (!is_array($columns)) {
      $columns = [$columns];
    }
    $freeCols[Screen::SMALL] = 12;
    $freeCols[Screen::MEDIUM] = 12;
    $freeCols[Screen::LARGE] = 12;
    $newCols = 0;
    foreach ($columns as $column) {
      //var_dump($column instanceof Column);
      if ($column instanceof ColumnInterface) {
        //echo "colWidth: ";
        //var_dump($column->getWidth(Screen::LARGE));
        $freeCols[Screen::SMALL] -= $column->countUsedSpace(Screen::SMALL);
        $freeCols[Screen::MEDIUM] -= $column->countUsedSpace(Screen::MEDIUM);
        $freeCols[Screen::LARGE] -= $column->countUsedSpace(Screen::LARGE);
      } else {
        $newCols += 1;
      }
    }
    //echo "newCols: ";
    //var_dump($newCols);
    if ($newCols > 0) {
      foreach ($freeCols as $sreenType => $colCount) {
        //var_dump($colCount);
        $sType[$sreenType] = floor($colCount / $newCols);
        if ($sType[$sreenType] < 1) {
          $sType[$sreenType] = 1;
        }
      }
      if ($sType[Screen::LARGE] === $sType[Screen::MEDIUM]) {
        $sType[Screen::LARGE] = ColumnInterface::INHERITED;
      }
      if ($sType[Screen::MEDIUM] === $sType[Screen::SMALL]) {
        $sType[Screen::MEDIUM] = ColumnInterface::INHERITED;
      }
      //$colWidth = floor(12 / count($columns));
    }
    $this->clear();
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        $this->append($column);
      } else {
        $this->appendColumn($column, $sType[Screen::SMALL], $sType[Screen::MEDIUM], $sType[Screen::LARGE]);
      }
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
   * @return mixed[] wrapped content component(s) in an array
   */
  protected function parseContentToColumns($columns) {
    $wrapToCol = function($c) {
      if ($c instanceof ColumnInterface) {
        return $c;
      } else {
        return new Column($c);
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

  /**
   * {@inheritdoc}
   */
  public function appendColumn($content, $small = 12, $medium = null, $large = null) {
    $this->append(new Column($content, $small, $medium, $large));
    return $this;
  }

}
