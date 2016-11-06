<?php

/**
 * AbstractLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\ComponentInterface;

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
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;

  /**
   * the url pointing to the API documentation root
   *
   * @var string|null
   */
  private $target;

  /**
   * the default target of the hyperlinks generated
   *
   * @var string
   */
  private $defaultCssClasses;

  /**
   * Constructs a new instance
   *
   * @param UrlGeneratorInterface $urlGenerator the url pointing to the API documentation
   * @param string $defaultTarget the default target of the generated links
   * @param string|string[]|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct(UrlGeneratorInterface $urlGenerator, $defaultTarget = null, $defaultCssClasses = null) {
    $this->urlGenerator = $urlGenerator;
    $this->setDefaultCssClasses($defaultCssClasses);
    $this->setDefaultTarget($defaultTarget);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->urlGenerator, $this->defaultCssClasses, $this->target);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->urlGenerator = clone $this->urlGenerator;
  }

  public function __toString() {
    return $this->hyperlink()->getHtml();
  }

  public function urls() {
    return $this->urlGenerator;
  }

  public function createUrl($relative) {
    return $this->urlGenerator->create($relative);
  }

  public function getDefaultTarget() {
    return $this->target;
  }

  /**
   * 
   * @param  string|null $target
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setDefaultTarget($target) {
    $this->target = $target;
    return $this;
  }

  /**
   * Returns the default CSS classes used in the generated links
   *
   * @return string the default CSS classes used in the generated links
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function getDefaultCssClasses() {
    return $this->defaultCssClasses;
  }

  /**
   * Sets the default CSS classes for the generated links
   *
   * @param  string|null $defaultCssClasses the default CSS classes for the generated links
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function setDefaultCssClasses($defaultCssClasses = null) {
    $this->defaultCssClasses = $defaultCssClasses;
    return $this;
  }

  /**
   * Sets the default target and CSS classes to the hyperlink component
   * 
   * @param  HyperlinkInterface $a the hyperlink component to modify
   * @return HyperlinkInterface returns the modified component
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function insertDefaults(HyperlinkInterface $a) {
    if ($this->target !== null) {
      $a->setTarget($this->target);
    }
    if ($this->defaultCssClasses !== null && $a instanceof ComponentInterface) {
      $a->addCssClass($this->defaultCssClasses);
    }
    return $a;
  }

  public function hyperlink($url = null, $content = null, $title = null) {
    if ($url === null) {
      $url = $this->urls()->getRoot();
    }
    if ($content === null) {
      $content = $url;
    }
    $a = new Hyperlink($url, $content);
    if ($title !== null) {
      (new \Sphp\Html\Qtip\Qtippable($a))->setQtip($title)->setQtipPosition("top center", "bottom center");
    }
    $this->insertDefaults($a);
    return $a;
  }

}
