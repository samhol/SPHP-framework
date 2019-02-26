<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Traversable;

/**
 * Implements an abstract Foundation framework based XY Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractRow extends AbstractComponent implements \IteratorAggregate, Row {

  /**
   * @var PlainContainer
   */
  private $columns;

  /**
   * @var RowLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructor
   * 
   * @param string $tagname
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
    $this->layoutManager = new RowLayoutManager($this);
    $this->columns = new PlainContainer();
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
      if ($column instanceof Cell) {
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
   * @return Cell appended column
   */
  public function append(Cell $column): Cell {
    if (!($column instanceof Cell)) {
      $column = new DivCell($column);
    }
    $this->columns->append($column);
    return $column;
  }

  /**
   * Prepends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return Cell prepended column
   */
  public function prepend($column): Cell {
    if (!($column instanceof Cell)) {
      $column = new DivCell($column);
    }
    $this->columns->prepend($column);
    return $column;
  }

  public function appendColumn($content, array $sizes = ['auto']) {
    $this->append(new DivCell($content, $sizes));
    return $this;
  }

  public function appendMdColumn($content, array $sizes = ['auto']) {
    $p = new \ParsedownExtraPlugin();
    $this->append(new DivCell($p->parse($content), $sizes));
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

}
