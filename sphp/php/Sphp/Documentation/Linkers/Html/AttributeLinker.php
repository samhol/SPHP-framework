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
use Sphp\Html\Navigation\A;
use Sphp\Documentation\Linkers\HyperlinkFactory;

/**
 * Basic implementation of a hyperlink generator about an HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AttributeLinker extends AbstractItemLinker {

  /**
   * @var string 
   */
  private ?string $tagName;

  /**
   * @var string 
   */
  private string $attrName;

  /**
   * @var HtmlUrlGenerator
   */
  private HtmlUrlGenerator $urlGen;

  /**
   * Constructor
   *
   * @param string $attrName
   * @param string|null $tagName
   * @param HtmlUrlGenerator $gen
   * @param HyperlinkFactory $hyperlinkFactory
   */
  public function __construct(string $attrName, ?string $tagName = null, ?HtmlUrlGenerator $gen = null, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->attrName = $attrName;
    $this->tagName = $tagName;
    $this->urlGen = $gen;
    parent::__construct($hyperlinkFactory);
  }

  public function __destruct() {
    unset($this->urlGen);
    parent::__destruct();
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $linkText optional link text
   * @return A hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function __invoke(?string $linkText = null): A {
    return $this->toHyperlink($linkText);
  }

  /**
   * Checks if the attribute is global
   * 
   * @return bool true if the attribute is global
   */
  public function isGlobalAttribute(): bool {
    return $this->tagName === null;
  }

  /**
   * Returns the name of the attribute
   * 
   * @return string the name of the attribute
   */
  public function getAttributeName(): string {
    return $this->attrName;
  }

  public function getDefaultContent(): string {
    $linkText = '';
    if (!$this->isGlobalAttribute()) {
      $linkText = Utils::createTagContent($this->tagName) . ' ';
    }
    $linkText .= $this->getAttributeName() . ' attribute';
    return $linkText;
  }
  public function getDefaultTitle(): string {
    $linkText = 'Documentation of the ';
    if (!$this->isGlobalAttribute()) {
      $linkText = Utils::createTagContent($this->tagName) . ' ';
    }
    $linkText .= $this->getAttributeName() . ' attribute';
    return $linkText;
  }

  public function getUrl(): string {
    return $this->urlGen->getUrl($this->tagName, $this->attrName);
  }


}
