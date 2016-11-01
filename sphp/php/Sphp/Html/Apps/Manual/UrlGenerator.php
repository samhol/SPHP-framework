<?php

/**
 * AbstractApiLinkPathGenerator.php (UTF-8)
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
class UrlGenerator implements UrlGeneratorInterface {

  /**
   * the url pointing to the API documentation root
   *
   * @var string
   */
  private $root;

  /**
   * Constructs a new instance
   *
   * @param string $root the url pointing to the API documentation
   */
  public function __construct($root = '') {
    $this->root = $root;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->root, $this->target);
  }

  public function getRoot() {
    return $this->root;
  }

  public function create($relative = '') {
    return $this->root . $relative;
  }

  /**
   * Sets the url pointing to the API documentation
   *
   * @param  string $root the site root
   * @return self for PHP Method Chaining
   */
  public function setRoot($root) {
    $this->root = $root;
    return $this;
  }

}
