<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\Component;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Stdlib\Strings;

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
   * @var array
   */
  private $attributes = [];

  /**
   * Constructor
   *
   * @param UrlGeneratorInterface $urlGenerator the URL pointing to the API documentation
   */
  public function __construct(UrlGeneratorInterface $urlGenerator) {
    $this->urlGenerator = $urlGenerator;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->urlGenerator, $this->attributes);
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
    return $this->urlGenerator->createUrl($relative);
  }

  public function setDefaultHyperlinkAttributes(array $attributes) {
    $this->attributes = $attributes;
    return $this;
  }

  public function getDefaultHyperlinkAttributes(): array {
    return $this->attributes;
  }

  /**
   * Sets the default attributes to a given component
   * 
   * @param  Component $a the component to modify
   * @return Component returns the modified component
   */
  public function insertDefaultsTo(Component $a): Component {
    if (!empty($this->attributes)) {
      $a->attributes()->merge($this->attributes);
    }
    return $a;
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if (!Strings::startsWith("$url", $this->urls()->getRoot())) {
      $url = $this->urls()->createUrl("$url");
    }
    if ($content === null) {
      $content = $url;
    }
    $a = new Hyperlink($url, $content);
    if ($title !== null) {
      $a->attributes()->title = $title;
      //(new QtipAdapter($a))->setQtip($title)->setQtipPosition('bottom center', 'top center');
    }
    $this->insertDefaultsTo($a);
    return $a;
  }

}
