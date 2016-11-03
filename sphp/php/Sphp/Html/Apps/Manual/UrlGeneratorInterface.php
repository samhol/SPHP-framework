<?php

/**
 * UrlGeneratorInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Defines a URL string generator pointing to an online site
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface UrlGeneratorInterface {

  /**
   * Returns the url pointing to the root of the page
   *
   * @return string the url pointing to the API documentation
   */
  public function getRoot();

  /**
   * Creates an URL string pointing to the resource
   *
   * @param  string $relative path from the root to the resource
   * @return string an URL string pointing to the resource
   */
  public function create($relative);
}
