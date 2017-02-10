<?php

/**
 * QtipTrait.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Qtip;

/**
 * Description of QtipTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_title.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait QtipTrait {

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $qtip the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setQtip($qtip) {
    $this->setAttr("title", $qtip);

    return $this;
  }

}
