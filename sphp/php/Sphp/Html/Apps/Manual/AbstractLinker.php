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
   * the default target of the hyperlinks generated
   *
   * @var string
   */
  private $defaultCssClasses;

  /**
   * Constructs a new instance
   *
   * @param string $apiRoot the url pointing to the API documentation
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct($apiRoot = "", $defaultTarget = "_blank", $defaultCssClasses = null) {
    $this->setApiRoot($apiRoot)
            ->setDefaultTarget($defaultTarget)
            ->setDefaultCssClasses($defaultCssClasses);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->apiRoot, $this->defaultTarget);
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
   * Sets the url pointing to the API documentation
   *
   * @param  string $apiRoot the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  private function setApiRoot($apiRoot) {
    $this->apiRoot = $apiRoot;
    return $this;
  }

  /**
   * Returns the default target of the generated links
   *
   * @return string the default target of the generated links
   */
  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  /**
   * Sets the default CSS classes used in the generated links
   *
   * @param  string $defaultTarget the default target of the generated links
   * @return self for PHP Method Chaining
   */
  public function setDefaultTarget($defaultTarget) {
    $this->defaultTarget = $defaultTarget;
    return $this;
  }

  /**
   * Returns the default CSS classes used in the generated links
   *
   * @return string the default CSS classes used in the generated links
   */
  public function getDefaultCssClasses() {
    return $this->defaultCssClasses;
  }

  /**
   * Sets the default CSS classes for the generated links
   *
   * @param  string|null $defaultTarget the default CSS classes for the generated links
   * @return self for PHP Method Chaining
   */
  public function setDefaultCssClasses($defaultCssClasses = null) {
    $this->defaultCssClasses = $defaultCssClasses;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    if (Strings::isEmpty($content)) {
      $content = $relativeUrl;
    }
    $a = new Hyperlink($this->getApiRoot() . $relativeUrl, $content);
    $a->setTarget($this->getDefaultTarget());
    if (Strings::notEmpty($title)) {
      $a->setTitle($title);
    }
    if ($this->defaultCssClasses !== null) {
      $a->addCssClass($this->defaultCssClasses);
    }
    return $a;
  }

}
