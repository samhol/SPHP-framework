<?php

/**
 * PaneInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\Lists\LiInterface;

/**
 * Defines a Pane for Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PaneInterface extends LiInterface {

  /**
   * Sets the title of the accordion pane
   *
   * @param  mixed $title the heading content
   * @return $this for a fluent interface
   */
  public function setPaneTitle($title);

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  boolean $visibility true if the content is visible, false otherwise
   * @return $this for a fluent interface
   */
  public function contentVisible(bool $visibility = true);
}
