<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Foundation\Sites\Core\Screen;
use Sphp\Html\WrappingContainer;
use Sphp\Html\NonVisualContentInterface;

/**
 * Implements a row
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
      if ($c instanceof NonVisualContentInterface || $c instanceof ColumnInterface) {
        return $c;
      } else {
        return new Column($c);
      }
    };
    parent::__construct('div', null, new WrappingContainer($wrapToCol));
    if ($columns !== null) {
      $this->setColumns($columns);
    }
    $this->cssClasses()->lock('row');
  }

  public function setColumns($columns) {
    if (!is_array($columns)) {
      $columns = [$columns];
    }
    foreach (Screen::sizes() as $sizeName) {
      $freeCols[$sizeName] = 12;
    }
    $newCols = 0;
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        foreach ($freeCols as $sizeName => $freeSpace) {
          $freeCols[$sizeName] = $freeSpace - $column->countUsedSpace($sizeName);
        }
      } else {
        $newCols += 1;
      }
    }
    if ($newCols > 0) {
      $prev = $freeCols['small'];
      foreach ($freeCols as $sreenType => $colCount) {
        //var_dump($colCount);
        $sType[$sreenType] = floor($colCount / $newCols);
        if ($sType[$sreenType] < 1) {
          $sType[$sreenType] = 1;
        }
      }
      foreach ($freeCols as $sizeName => $freeSpace) {
        if ($sizeName != 'small' && $freeSpace == $prev) {
          $sType[$sizeName] = false;
        }
      }
      //$colWidth = floor(12 / count($columns));
    }
    $this->clear();
    //print_r($sType);
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        $this->append($column);
      } else {
        $this->appendColumn($column, $sType['small'], $sType['medium'], $sType['large'], $sType['xlarge'], $sType['xxlarge']);
      }
    }
    return $this;
  }

  public function appendColumn($content, $s = 12, $m = false, $l = false, $xl = false, $xxl = false) {
    $this->append(new Column($content, $s, $m, $l, $xl, $xxl));
    return $this;
  }

  public function appendMdColumn($content, $s = 12, $m = false, $l = false, $xl = false, $xxl = false) {
    $p = new \ParsedownExtraPlugin();
    $this->append(new Column($p->parse($content), $s, $m, $l, $xl, $xxl));
    return $this;
  }

  public function collapseColumns($collapse = true) {
    if ($collapse) {
      $this->cssClasses()->add('collapse');
    } else {
      $this->cssClasses()
              ->remove('collapse');
    }
    return $this;
  }

  public function collapseColumnsFor($screenSize = 'small', $collapse = true) {
    if ($collapse) {
      $this->cssClasses()
              ->remove("$screenSize-uncollapse")
              ->add("$screenSize-collapse");
    } else {
      $this->cssClasses()
              ->add("$screenSize-uncollapse")
              ->remove("$screenSize-collapse");
    }
    return $this;
  }

}
