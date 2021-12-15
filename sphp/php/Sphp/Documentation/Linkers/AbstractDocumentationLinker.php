<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;

use Sphp\Html\AbstractContent;
use Sphp\Html\Navigation\A;

/**
 * Abstract Hyperlink generator pointing to an API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractDocumentationLinker extends AbstractContent implements DocumentationLinker, ItemLinker {

  private ApiUrlGenerator $urlGen;
  private HyperlinkFactory $hyperlinkFactory;

  /**
   * Constructor
   *
   * @param ApiUrlGenerator $urlGen
   * @param HyperlinkFactory $hyperlinkFactory
   */
  public function __construct(ApiUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->urlGen = $urlGen;
    if ($hyperlinkFactory === null) {
      $hyperlinkFactory = new HyperlinkFactory();
    }
    $this->setHyperlinkFactory($hyperlinkFactory);
  }

  public function __destruct() {
    unset($this->urlGen, $this->hyperlinkFactory);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->urlGen = clone $this->urlGen;
    $this->hyperlinkFactory = clone $this->hyperlinkFactory;
  }

  /**
   * Returns the URL generator pointing to the API documentation
   *
   * @return ApiUrlGenerator the URL generator pointing to the API documentation
   */
  public function urls(): ApiUrlGenerator {
    return $this->urlGen;
  }

  /**
   * 
   * @return HyperlinkFactory new cloned instance
   */
  public function cloneHyperlinkFactory(): HyperlinkFactory {
    return clone $this->hyperlinkFactory;
  }

  /**
   * 
   * @return HyperlinkFactory
   */
  public function getHyperlinkFactory(): HyperlinkFactory {
    return $this->hyperlinkFactory;
  }

  /**
   * 
   * @param  HyperlinkFactory $hyperlinkFactory
   * @return $this for a fluent interface
   */
  public function setHyperlinkFactory(HyperlinkFactory $hyperlinkFactory) {
    $this->hyperlinkFactory = $hyperlinkFactory;
    return $this;
  }

  public function pointTo(?string $url = null, ?string $content = null): A {
    if ($url === null) {
      $url = $this->urls()->getRootUrl();
    }
    if ($content === null) {
      $content = $this->urls()->getApiname();
    }
    $a = $this->getHyperlinkFactory()->buildHyperlink($url, $content);
    return $a;
  }

  public function getHtml(): string {
    return $this->toHyperlink()->getHtml();
  }

  public function toHyperlink(?string $linkText = null): A {
    return $this->pointTo(null, $linkText);
  }

  public function getDefaultContent(): string {
    return $this->urlGen->getApiname();
  }

  public function getDefaultTitle(): string {
    return $this->urlGen->getApiname() . " documentation";
  }

  public function getUrl(): string {
    return $this->urlGen->getRootUrl();
  }

}
