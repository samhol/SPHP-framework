<?php

/**
 * UrlGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * URL string generator pointing to an online site
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UrlGenerator implements UrlGeneratorInterface {

  /**
   * the URL pointing to the API documentation root
   *
   * @var string
   */
  private $root;

  /**
   * Constructs a new instance
   *
   * @param string $root the URL pointing to the API documentation
   */
  public function __construct(string $root = '') {
    $this->root = $root;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->root);
  }

  public function getRoot(): string {
    return $this->root;
  }

  /**
   * Sets the URL pointing to the API documentation
   *
   * @param  string $root the site root
   * @return self for a fluent interface
   */
  protected function setRoot(string $root) {
    $this->root = $root;
    return $this;
  }

  public function create(string $relative = ''): string {
    return $this->root . $relative;
  }

}
