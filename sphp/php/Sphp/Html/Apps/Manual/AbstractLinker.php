<?php

/**
 * AbstractLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Core\Types\Strings as Strings;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Hyperlink generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractLinker implements LinkerInterface {

  /**
   * the url pointing to the API documentation root
   *
   * @var string
   */
  private $apiRoot;
  
  /**
   * the default target of the hyperlinks generated
   *
   * @var string
   */
  private $defaultTarget;

  /**
   * the default attributes of the hyperlinks generated
   *
   * @var scalar[]
   */
  private $defaultAttrs;

  /**
   * Constructs a new instance
   *
   * @param string $apiRoot the url pointing to the API documentation
   * @param string $attrs the default value of the target attribute
   *        for the generated links
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($apiRoot = "", array $attrs = []) {
    $this->setApiRoot($apiRoot)->setDefaultAttributes($attrs);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->apiRoot, $this->defaultAttrs);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->apiRoot = clone $this->apiRoot;
    $this->defaultAttrs = clone $this->defaultAttrs;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return "" . $this->getHyperlink();
  }

  /**
   * {@inheritdoc}
   */
  public function getApiRoot() {
    return $this->apiRoot;
  }

  /**
   * Sets  the url pointing to the API documentation
   *
   * @param  string $apiRoot the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  private function setApiRoot($apiRoot) {
    $this->apiRoot = $apiRoot;
    return $this;
  }

  /**
   * Returns the default attribute of the generated links
   *
   * @return string the default value attributes of the generated links
   */
  public function getDefaultAttributes() {
    return $this->defaultAttrs;
  }

  /**
   * Sets the default attribute of the generated links
   *
   * @param  string $attrs the default attribute of the generated links
   * @return self for PHP Method Chaining
   */
  public function setDefaultAttributes(array $attrs) {
    $this->defaultAttrs = $attrs;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    if (Strings::isEmpty($content)) {
      $content = $relativeUrl;
    }
    $a = (new Hyperlink($this->getApiRoot() . $relativeUrl, $content))->setAttrs($this->getDefaultAttributes());
    if (Strings::notEmpty($title)) {
      $a->setTitle($title);
    }
    return $a;
  }

}
