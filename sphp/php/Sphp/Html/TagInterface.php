<?php

/**
 * TagInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Interface is the base for all HTML tag implementations
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TagInterface extends ComponentInterface {

  /**
   * Returns the tag name of the component
   *
   * @return string the tag name of the component
   */
  public function getTagName();
}
