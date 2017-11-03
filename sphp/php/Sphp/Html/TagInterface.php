<?php

/**
 * TagInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Interface is the base for build in HTML tag implementations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TagInterface extends ComponentInterface {

  /**
   * Returns the tag name of the component
   *
   * @return string the tag name of the component
   */
  public function getTagName(): string;
}

