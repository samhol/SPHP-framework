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

use Sphp\Documentation\Linkers\AbstractItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;

/**
 * API link builder for HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class TagLinker extends AbstractItemLinker {

  private string $tagName;
  private HtmlUrlGenerator $urlGen;

  /**
   * Constructor
   *
   * @param string $tagName
   * @param HtmlUrlGenerator $gen
   * @param HyperlinkFactory|null $attributeInjector
   */
  public function __construct(string $tagName, HtmlUrlGenerator $gen, ?HyperlinkFactory $attributeInjector = null) {
    $this->tagName = $tagName;
    $this->urlGen = $gen;
    parent::__construct($attributeInjector);
  }

  public function __destruct() {
    unset($this->urlGen);
    parent::__destruct();
  }

  /**
   * Returns an API linker pointing to the documentation of the given attribute of this HTML tag 
   * 
   * @param  string $attrName attribute name
   * @return AttributeLinker pointing to given tag attribute
   */
  public function __get(string $attrName): AttributeLinker {
    return $this->createAttrLink($attrName);
  }

  /**
   * Returns a new instance of the attribute linker
   * 
   * @param  string $attrName attribute name
   * @return AttributeLinker a new instance
   */
  public function __invoke(string $attrName): AttributeLinker {
    return $this->createAttrLink($attrName);
  }

  /**
   * Returns a new instance of the attribute linker
   * 
   * @param  string $attrName attribute name
   * @return AttributeLinker a new instance
   */
  public function createAttrLink(string $attrName): AttributeLinker {
    return new AttributeLinker($attrName, $this->tagName, $this->urlGen, $this->cloneHyperlinkFactory());
  }

  public function getDefaultContent(): string {
    return (string) Utils::createTagContent($this->tagName);
  }

  public function getDefaultTitle(): string {
    return 'Docmentation of the ' . $this->tagName . ' tag';
  }

  public function getUrl(): string {
    return $this->urlGen->getUrl($this->tagName);
  }

}
