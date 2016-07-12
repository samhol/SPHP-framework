<?php

/**
 * PhpApiLinkerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PhpApiLinkerInterface {

  /**
   * Return the class property linker
   *
   * @param  string|\object $class class name or object
   * @return ClassLinkerInterface the class property linker
   */
  public function classLinker($class);
}
