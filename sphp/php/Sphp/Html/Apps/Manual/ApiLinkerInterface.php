<?php

/**
 * ApiLinkerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ApiLinkerInterface extends LinkerInterface {

  /**
   * Return the class property linker
   *
   * @param  string|\object $class class name or object
   * @return AbstractClassLinker the class property linker
   */
  public function classLinker($class);

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return HyperlinkInterface hyperlink object pointing to an API namespace page1
   */
  public function namespaceLink($namespace, $fullName = true);
}
