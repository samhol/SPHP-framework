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
class ApiLinkPathGenerator implements LinkPathGeneratorInterface {

  /**
   * the url pointing to the API documentation root
   *
   * @var string
   */
  private $apiRoot;

  /**
   * the url pointing to the API documentation root
   *
   * @var string
   */
  private $target;

  /**
   * Constructs a new instance
   *
   * @param string $apiRoot the url pointing to the API documentation
   * @param string $target the default target of the generated links
   */
  public function __construct($apiRoot = '', $target = '_blank') {
    $this->setRoot($apiRoot)
            ->setTarget($target);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->apiRoot);
  }

  public function getRoot() {
    return $this->apiRoot;
  }

  public function create($relative = '') {
    return $this->apiRoot . $relative;
  }

  /**
   * Sets the url pointing to the API documentation
   *
   * @param  string $apiRoot the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  public function setRoot($apiRoot) {
    $this->apiRoot = $apiRoot;
    return $this;
  }

  public function getTarget() {
    return $this->target;
  }

  public function setTarget($target) {
    $this->target = $target;
    return $this;
  }

}
