<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;

/**
 * Implements an HTML &lt;colgroup&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_colgroup.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Colgroup extends AbstractComponent implements TableContent {

  /**
   * @var PlainContainer
   */
  private $cols;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('colgroup');
    $this->cols = new PlainContainer;
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
