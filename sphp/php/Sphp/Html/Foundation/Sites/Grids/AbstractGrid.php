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
use Sphp\Html\Container;
use Sphp\Html\TraversableContent;
use Traversable;

/**
 * Implements an abstract Foundation framework based XY Grid container for rows
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
   *
   * @param  string $tagname the tag name of the component
   */
  public function __construct(string $tagname) {
    parent::__construct($tagname);
    $this->content = new Container();
    $this->layoutManager = new GridLayoutManager($this);
  }

  public function layout(): GridLayoutManagerInterface {
    return $this->layoutManager;
  }

  public function getColumns(): TraversableContent {
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
