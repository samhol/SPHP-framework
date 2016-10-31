<?php

/**
 * AbstractLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;

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
   * @var LinkPathGeneratorInterface
   */
  private $linkGenerator;

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
   * @param LinkPathGeneratorInterface $apiRoot the url pointing to the API documentation
   * @param string|string[]|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct(LinkPathGeneratorInterface $apiRoot, $defaultCssClasses = null) {
    $this->setLinkGenerator($apiRoot)
            ->setDefaultCssClasses($defaultCssClasses);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->linkGenerator);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->linkGenerator = clone $this->linkGenerator;
  }

  public function __toString() {
    return $this->hyperlink()->getHtml();
  }

  public function getLinkGenerator() {
    return $this->linkGenerator;
  }

  /**
   * Sets the url pointing to the API documentation
   *
   * @param  LinkPathGeneratorInterface $linkGenerator the url pointing to the API documentation
   * @return self for PHP Method Chaining
   */
  private function setLinkGenerator(LinkPathGeneratorInterface $linkGenerator) {
    $this->linkGenerator = $linkGenerator;
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
   * @param  string|null $defaultCssClasses the default CSS classes for the generated links
   * @return self for PHP Method Chaining
   */
  public function setDefaultCssClasses($defaultCssClasses = null) {
    $this->defaultCssClasses = $defaultCssClasses;
    return $this;
  }

  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    if ($relativeUrl === null) {
      $relativeUrl = $this->getLinkGenerator()->getRoot();
    }
    if ($content === null) {
      $content = $relativeUrl;
    }
    $a = new Hyperlink($relativeUrl, $content);
    $a->setTarget($this->getLinkGenerator()->getTarget());
    if ($title !== null) {
      $a->setTitle($title);
    }
    if ($this->defaultCssClasses !== null) {
      $a->addCssClass($this->defaultCssClasses);
    }
    return $a;
  }

}
