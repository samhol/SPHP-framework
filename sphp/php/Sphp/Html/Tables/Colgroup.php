<?php

/**
 * Colgroup.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Container;

/**
 * Implements an HTML &lt;colgroup&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_colgroup.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Colgroup extends AbstractComponent implements TableContent {

  /**
   * @var Container
   */
  private $cols;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('colgroup');
    $this->cols = new Container;
  }

  /**
   * Appends a new &lt;col&gt; component with specific span
   *
   * @param  int $span specifies the number of columns a col element should span
   * @return Col appended instance
   */
  public function appendCol(int $span = 1): Col {
    $col = new Col($span);
    $this->append($col);
    return $col;
  }

  /**
   * Appends cols(s) to the colgroup
   *
   * @param  Col,... $cols The ColTag(s) objects that specifies column properties
   * @return $this for a fluent interface
   */
  public function append(Col ...$cols) {
    $this->cols->append($cols);
    return $this;
  }

  /**
   * Prepends cols(s) to the colgroup
   *
   * @param  Col $cols  objects
   * @return $this for a fluent interface
   */
  public function prepend(Col $cols) {
    $this->cols->prepend($cols);
    return $this;
  }

  /**
   * Prepends a new &lt;col&gt; component with specific span
   *
   * @param  int $span specifies the number of columns a col element should span
   * @return Col prepended instance
   */
  public function prependCol(int $span = 1): Col {
    $col = new Col($span);
    $this->prepend($col);
    return $col;
  }

  public function contentToString(): string {
    return $this->cols;
  }

}
