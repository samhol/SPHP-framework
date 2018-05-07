<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Implements a &lt;td&gt; data cell for an HTML &lt;table&gt;
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Td extends AbstractCell {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the component
   * @param int $colspan specifies the number of columns cell should span
   * @param int $rowspan specifies the number of rows cell should span
   * @link  http://www.w3schools.com/tags/att_td_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_td_rowspan.asp rowspan attribute
   */
  public function __construct($content = null, int $colspan = 1, int $rowspan = 1) {
    parent::__construct('td', $content);
    $this->setColspan($colspan);
    $this->setRowspan($rowspan);
  }

}
