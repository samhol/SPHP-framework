<?php

/**
 * GridUtil.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

/**
 * Class GridUtil
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridUtil {

  /**
   * 
   * @param  array $columns
   * @return ColumnInterface[]
   */
  public static function createRow($columns) {
    $result = [];
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
        $freeCols[Screen::SMALL] -= static::countColumnSpace($column, Screen::SMALL);
        $freeCols[Screen::MEDIUM] -= static::countColumnSpace($column, Screen::MEDIUM);
        $freeCols[Screen::LARGE] -= static::countColumnSpace($column, Screen::LARGE);
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
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        $result[] = $column;
      } else {
        $result[] = new Column($column, $sType[Screen::SMALL], $sType[Screen::MEDIUM], $sType[Screen::LARGE]);
      }
    }
    return $result;
  }

  /**
   * Returns the amount of the space the column uses from the grid row
   * 
   * @preconditions  parameter `$screen` is either one of the constants 
   *                 {@link Screen::SMALL}, 
   *                 {@link Screen::MEDIUM},
   *                 {@link Screen::LARGE} or one of the strings 
   *                 `"small"`, `"medium"`, `"large"`
   * @param  ColumnInterface $column
   * @param  int|string $screen
   * @return int
   */
  public static function countColumnSpace(ColumnInterface $column, $screen) {
    return $column->getWidth($screen) + $column->getGridOffset($screen);
  }

}
