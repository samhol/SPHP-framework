<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Manual;

/**
 * URL string generator pointing to an online site
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * @return $this for a fluent interface
   */
  protected function setRoot(string $root) {
    $this->root = $root;
    return $this;
  }

  public function create(string $relative = ''): string {
    return $this->root . $relative;
  }

}
