<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\Container;

/**
 * Interface is the base definition for all {@link Tr} content (table cells)
 * 
 * An HTML table has two kinds of cells:
 *
 *  **Header cells** - contains header information (created with the &lt;th&gt; element).
 *  The text in &lt;th&gt; elements are bold and centered by default.
 * 
 *  **Standard cells** - contains data (created with the &lt;td&gt; element).
 *  The text in &lt;td&gt; elements are regular and left-aligned by default.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_td.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-td-element W3C API
 * @link    http://www.w3schools.com/tags/tag_th.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-th-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ContainerCell extends Cell, Container {
  
}
