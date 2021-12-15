<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Image;

use Sphp\Html\AbstractContent;
use DOMDocument;
use DOMNode;

/**
 * Implements an SVG image object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Svg extends AbstractContent {

  /**
   * @var DOMDocument
   */
  private DOMDocument $doc;

  /**
   * @var DOMNode
   */
  private DOMNode $svg;

  /**
   * Constructor
   * 
   * @param DOMDocument $doc
   */
  public function __construct(DOMDocument $doc) {
    $this->doc = $doc;
    $this->svg = $doc->getElementsByTagName('svg')->item(0);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->doc, $this->svg);
  }

  /**
   * Returns the DOM document object
   * 
   * @return DOMDocument the DOM document object
   */
  public function getDoc(): DOMDocument {
    return $this->doc;
  }

  /**
   * Returns the SVG node
   * 
   * @return DOMNode the SVG node
   */
  public function getSvg(): DOMNode {
    return $this->svg;
  }

  /**
   * Sets the title of the SVG image
   * 
   * @param string $title
   * @return $this for a fluent interface
   */
  public function setTitle(string $title = null) {
    if ($title !== null) {
      $titleNode = $this->doc->getElementsByTagName('title')->item(0);
      if ($titleNode === null) {
        $titleNode = $this->doc->createElement('title');
        $this->svg->insertBefore($titleNode, $this->svg->firstChild);
      }
      $titleNode->textContent = $title;
    } else {
      $titles = $this->svg->getElementsByTagName('title');
      foreach ($titles as $title) {
        $this->svg->removeChild($title);
      }
    }
    return $this;
  }

  /**
   * Sets the opacity of the SVG image
   * 
   * @param  float $opacity
   * @return $this for a fluent interface
   */
  public function setOpacity(float $opacity = null) {
    if ($opacity !== null) {
      $this->svg->setAttribute('opacity', (string) $opacity);
    } else {
      $this->svg->removeAttribute('opacity');
    }
    return $this;
  }

  /**
   * 
   * @param string $color
   * @param float $width
   * @return $this for a fluent interface
   */
  public function setStroke(string $color, float $width) {
    $graphs = $this->getSvg()->getElementsByTagName('g');
    foreach ($graphs as $g) {
      $g->setAttribute('stroke', $color);
      $g->setAttribute('stroke-width', $width);
    }
    return $this;
  }

  /**
   * Sets the width of the SVG image
   * 
   * @param  float|string|null $width
   * @return $this for a fluent interface
   */
  public function setWidth($width = null) {
    if (is_numeric($width)) {
      $width .= 'px';
    }
    if (is_string($width)) {
      $this->getSvg()->setAttribute('width', $width);
    } else {
      $this->getSvg()->removeAttribute('width');
    }
    return $this;
  }

  /**
   * Sets the height of the SVG image
   * 
   * @param  float|string $height
   * @return $this for a fluent interface
   */
  public function setHeight($height = null) {
    if (is_numeric($height)) {
      $height .= 'px';
    }
    if (is_string($height)) {
      $this->svg->setAttribute('height', $height);
    } else {
      $this->svg->removeAttribute('height');
    }
    return $this;
  }

  /**
   * Sets the color of the SVG image
   * 
   * @param string $color
   * @return $this for a fluent interface
   */
  public function setColor(string $color = '#000') {
    $graphs = $this->getSvg()->getElementsByTagName('g');
    foreach ($graphs as $g) {
      $g->setAttribute('fill', $color);
    }
    return $this;
  }

  public function setText(string $text) {
    $textElement = $this->getDoc()->createElement('text', $text);
    $textElement->setAttribute('style', 'stroke: #f44; stroke-width:8px;fill:#000;font-family:Arial,Helvetica;font-size:60px;');
    $textElement->setAttribute('x', '50%');
    $textElement->setAttribute('y', '50%');
    $textElement->setAttribute('dominant-baseline', 'middle');
    $textElement->setAttribute('text-anchor', 'middle');
    $this->getSvg()->appendChild($textElement);
    return $this;
  }

  public function getHtml(): string {
    return $this->doc->saveHTML($this->svg);
  }

}
