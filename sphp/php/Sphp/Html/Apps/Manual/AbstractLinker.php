<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Adapters\QtipAdapter;

/**
 * Hyperlink generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractLinker implements LinkerInterface {

  /**
   * the URL pointing to the API documentation root
   *
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;

  /**
   * the target of the hyperlink
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
   * Constructor
   *
   * @param UrlGeneratorInterface $urlGenerator the url pointing to the API documentation
   * @param string $defaultTarget the default target of the generated links
   * @param string|string[]|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct(UrlGeneratorInterface $urlGenerator, string $defaultTarget = null, $defaultCssClasses = null) {
    $this->urlGenerator = $urlGenerator;
    $this->setDefaultCssClasses($defaultCssClasses);
    if ($defaultTarget !== null) {
      $this->setDefaultTarget($defaultTarget);
    }
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

  public function __toString(): string {
    return $this->hyperlink()->getHtml();
  }

  /**
   * Returns a hyperlink object pointing to a linked page
   *
   * @param  string $url optional path from the root to the resource
   * @param  string $content optional content of the link
   * @param  string $title optional title of the link
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   * @return HyperlinkInterface hyperlink object pointing to an API page
   */
  public function __invoke($url = null, $content = null, $title = null) {
    return $this->hyperlink($url, $content, $title);
  }

  public function urls(): UrlGeneratorInterface {
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
   * @param  string $target
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setDefaultTarget(string $target) {
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
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function setDefaultCssClasses($defaultCssClasses = null) {
    $this->defaultCssClasses = $defaultCssClasses;
    return $this;
  }

  /**
   * Sets the default target and CSS classes to the hyperlink component
   * 
   * @param  Hyperlink $a the hyperlink component to modify
   * @return Hyperlink returns the modified component
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function insertDefaults(Hyperlink $a): Hyperlink {
    if ($this->target !== null) {
      $a->setTarget($this->target);
    }
    if ($this->defaultCssClasses !== null && $a instanceof ComponentInterface) {
      $a->addCssClass($this->defaultCssClasses);
    }
    return $a;
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if (!\Sphp\Stdlib\Strings::startsWith("$url", $this->urls()->getRoot())) {
      $url = $this->urls()->create("$url");
    }
    if ($content === null) {
      $content = $url;
    }
    $a = new Hyperlink($url, $content);
    if ($title !== null) {
      (new QtipAdapter($a))->setQtip($title)->setQtipPosition('bottom center', 'top center');
    }
    $this->insertDefaults($a);
    return $a;
  }

}
