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
 * Implements an HTML &lt;tfoot&gt; tag.
 *
 *  The {@link self} component is used to group footer content in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tfoot.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
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
