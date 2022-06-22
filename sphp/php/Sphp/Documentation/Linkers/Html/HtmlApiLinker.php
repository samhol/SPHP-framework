<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\Html;

use Sphp\Documentation\Linkers\AbstractDocumentationLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\ItemLinker;

/**
 * Hyperlink generator pointing to online w3schools documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlApiLinker extends AbstractDocumentationLinker {

  private HtmlUrlGenerator $urlGen;

  /**
   * Constructor
   *
   * @param HtmlUrlGenerator $gen
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(HtmlUrlGenerator $gen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->urlGen = $gen;
    if ($hyperlinkFactory === null) {
      $hyperlinkFactory = new HyperlinkFactory();
    }
    $hyperlinkFactory->useCssClass('api', 'html');
    parent::__construct($gen, $hyperlinkFactory);
  }

  public function __destruct() {
    unset($this->urlGen);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->urlGen = clone $this->urlGen;
  }

  /**
   * Returns a hyperlink object pointing to the documentation of the given HTML documentation page
   *  
   * @param string|null $tagName the HTML5 tag name
   * @param string|null $attrName
   * @return ItemLinker hyperlink object pointing to the documentation of the given API page
   */
  public function __invoke(?string $tagName = null, ?string $attrName = null): ItemLinker {
    $out = null;
    if ($tagName === null && $attrName === null) {
      $out = clone $this;
    } else if ($tagName === null) {
      $out = $this->createGlobalAttrLink($attrName);
    } else if ($attrName === null) {
      $out = $this->createTagLink($tagName);
    } else {
      $out = $this->createTagAttrLink($tagName, $attrName);
    }
    return $out;
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagName the HTML5 tag name
   * @return TagLinker hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function __get(string $tagName): TagLinker {
    return $this->createTagLink($tagName);
  }

  /**
   * Returns a hyperlink object pointing to the documentation of the given HTML5 tag
   * 
   * @param  string $tagName the HTML5 tag name
   * @return TagLinker hyperlink factory pointing to the API documentation of the tag
   */
  public function createTagLink(string $tagName): TagLinker {
    return new TagLinker($tagName, clone $this->urls(), $this->getHyperlinkFactory()->getCopy());
  }

  /**
   * Returns a hyperlink object pointing to the documentation of the given HTML5 tag attribute
   * 
   * @param  string $tagName the HTML5 tag name
   * @param  string $attrName attribute name
   * @return AttributeLinker hyperlink factory pointing to the API documentation of the attribute
   */
  public function createTagAttrLink(string $tagName, string $attrName): AttributeLinker {
    return $this->createTagLink($tagName)->createAttrLink($attrName);
  }

  /**
   * Returns a hyperlink object pointing to the documentation of the given HTML5 tag attribute
   * 
   * @param  string $attrName attribute name
   * @return AttributeLinker hyperlink factory pointing to the API documentation of the attribute
   */
  public function createGlobalAttrLink(string $attrName): AttributeLinker {
    return new AttributeLinker($attrName, null, clone $this->urls(), $this->getHyperlinkFactory()->getCopy());
  }

}
