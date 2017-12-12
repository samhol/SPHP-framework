<?php

/**
 * Tfoot.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;tfoot&gt; tag.
 *
 *  The {@link self} component is used to group footer content in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tfoot.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tfoot extends TableRowContainer {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('tfoot');
  }

  public function fromArray(array $arr) {
    foreach ($arr as $tr) {
      if (!($tr instanceof RowInterface)) {
        $this->append(Tr::fromThs($tr));
      }
    }
    return $this;
  }

}
