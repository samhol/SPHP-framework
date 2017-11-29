<?php

/**
 * AbstractGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;
use Sphp\Html\ContainerInterface;
use Traversable;

/**
 * Implements an abstract Foundation framework based XY Grid container for rows
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractGrid extends AbstractComponent implements \IteratorAggregate, GridInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Container 
   */
  private $content;

  /**
   * @var GridLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * 1. Parameter `mixed $content` can be of any type that converts to a string 
   *    or to an array of strings. So also objects of any type that implement magic 
   *    method `__toString()` are allowed.
   * 2. `mixed $content` is transformed to a @link Row} component.
   *
   * @param  string $tagname the tag name of the component
   */
  public function __construct(string $tagname) {
    parent::__construct($tagname);
    $this->content = new Container();
    $this->layoutManager = new GridLayoutManager($this);
  }

  public function getColumns(): ContainerInterface {
    return $this->getComponentsByObjectType(ColumnInterface::class);
  }

  public function append($row) {
    if (!($row instanceof RowInterface)) {
      $row = new Row($row);
    }
    $this->content->append($row);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function count(): int {
    return $this->content->count();
  }

  public function prepend($row) {
    if (!($row instanceof RowInterface)) {
      $row = new Row($row);
    }
    $this->content->prepend($row);
    return $this;
  }

  /**
   * Create a new iterator to iterate through Grid content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->content->getIterator();
  }

}
