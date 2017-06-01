<?php

/**
 * BlockGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use Sphp\Html\TraversableTrait;
use Sphp\Html\WrappingContainer;
use Sphp\Html\ContentParserInterface;
use Sphp\Html\ContentParsingTrait;

/**
 * Implements a Block Grid component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-02-13
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGrid extends AbstractContainerComponent implements IteratorAggregate, ContentParserInterface, TraversableInterface {

  use TraversableTrait,
      ContentParsingTrait;

  /**
   * @var BlockGridLayoutManager 
   */
  private $layoutManager;

  /**
   * The maximum block grid value (int 12)
   */
  const MAX_GRID = 8;

  /**
   * The block grid value is inherited from the smaller screen (int 0)
   */
  const INHERITED = 0;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * This component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * If you use the small block grid only, the grid will keep its spacing and
   * configuration no matter the screen size. If you use large block grid
   * only, the list items will stack on top of each other for small devices.
   * If you use both of those classes combined, you can control the
   * configuration and layout separately for each breakpoint.
   *
   * @param  array $layout column layout parameters
   * @param  mixed [] $blocks
   */
  public function __construct(array $layout = ['small-up-8'], array $blocks = null) {
    $wrapper = function($c) {
      if (!($c instanceof BlockGridColumnInterface)) {
        $c = new BlockGridColumn($c);
      }
      return $c;
    };
    parent::__construct('div', null, new WrappingContainer($wrapper));
    $this->layoutManager = new BlockGridLayoutManager($this);
    $this->layout()->setLayouts($layout);
    if ($blocks !== null) {
      $this->setColumns($blocks);
    }
  }

  public function layout() {
    return $this->layoutManager;
  }

  /**
   * Sets the Column to the container
   * 
   * @param  array $columns columns or column contents
   * @return self for a fluent interface
   */
  public function setColumns(array $columns) {
    $this->getInnerContainer()->clear();
    foreach ($columns as $column) {
      $this->append($column);
    }
    return $this;
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  mixed $column column or column content
   * @return self for a fluent interface
   */
  public function append($column) {
    $this->getInnerContainer()->append($column);
    return $this;
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  int $index column or column content
   * @return BlockGridColumn|null
   */
  public function getColumn($index) {
    return $this->getInnerContainer()->offsetGet($index);
  }

  public function getIterator() {
    return $this->getInnerContainer()->getIterator();
  }

  public function count() {
    return $this->getInnerContainer()->count();
  }

}
