<?php

/**
 * UrlGeneratorInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * URL string generator pointing to an existing API documentation
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
   * Sets the url pointing to the root of the site
   *
   * @param  string $root the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  public function setRoot($root);

  /**
   * Creates an URL string pointing to the resource
   *
   * @param  string $relative path from the root to the resource
   * @return string an URL string pointing to the resource
   */
  public function create($relative);
}
