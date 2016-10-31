<?php

/**
 * ApiLinkPathGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Hyperlink generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ApiLinkPathGeneratorInterface {

  /**
   * Returns the default target of the generated links
   *
   * @return string the default target of the generated links
   */
  public function getTarget();

  /**
   * Sets the default target frame name of the generated links
   *
   * @param  string $target the default target of the generated links
   * @return self for PHP Method Chaining
   */
  public function setTarget($target);

  /**
   * Returns the url pointing to the API documentation
   *
   * @return string the url pointing to the API documentation
   */
  public function getApiRoot();

  /**
   * Sets the url pointing to the API documentation
   *
   * @param  string $apiRoot the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  public function setApiRoot($apiRoot);
}
