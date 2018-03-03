<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;
use Traversable;

/**
 * Implements an abstract Foundation framework based XY Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractRow extends AbstractComponent implements \IteratorAggregate, RowInterface {

  /**
   * @var Container
   */
  private $columns;

  /**
   * @var RowLayoutManager 
   */
  private $layoutManager;

  public function __construct($tagname) {
    parent::__construct($tagname, null);
    $this->layoutManager = new RowLayoutManager($this);
    $this->columns = new Container();
  }

  public function layout(): RowLayoutManager {
    return $this->layoutManager;
  }

  public function setColumns($columns, array $sizes = null) {
    if (!is_array($columns)) {
      $columns = [$columns];
    }

    if ($sizes === null) {
      $sizes = ['auto'];
    }

    $this->columns->clear();
    //print_r($sType);
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        $this->append($column);
      } else {
        $this->appendColumn($column, $sizes);
      }
    }
    return $this;
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return ColumnInterface appended column
   */
  public function append($column): ColumnInterface {
    if (!($column instanceof ColumnInterface)) {
      $column = new Column($column);
    }
    $this->columns->append($column);
    return $column;
  }

  /**
   * Prepends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return ColumnInterface prepended column
   */
  public function prepend($column): ColumnInterface {
    if (!($column instanceof ColumnInterface)) {
      $column = new Column($column);
    }
    $this->columns->prepend($column);
    return $column;
  }

  public function appendColumn($content, array $sizes = ['auto']) {
    $this->append(new Column($content, $sizes));
    return $this;
  }

  public function appendMdColumn($content, array $sizes = ['auto']) {
    $p = new \ParsedownExtraPlugin();
    $this->append(new Column($p->parse($content), $sizes));
    return $this;
  }

  /**
   * Create a new iterator to iterate through Row content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->columns->getIterator();
  }

  public function contentToString(): string {
    return $this->columns->getHtml();
  }

  /**
   * 
   * @param  array $rows
   * @return self new instance
   */
  public static function from(array $rows) {
    return new Static($rows);
  }

}
