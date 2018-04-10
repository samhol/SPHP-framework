<?php

/**
 * Thead.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;thead&gt; tag
 *
 *  This component is used to group header content in a &lt;table&gt; component.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_thead.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Thead extends TableRowContainer {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('thead');
  }

}
