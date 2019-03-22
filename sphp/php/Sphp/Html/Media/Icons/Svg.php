<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

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
class Svg extends AbstractContent implements Icon {

  /**
   * @var DOMDocument
   */
  private $doc;

  /**
   * @var DOMNode
   */
  private $svg;

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
  protected function getDoc(): DOMDocument {
    return $this->doc;
  }

  /**
   * Returns the SVG node
   * 
   * @return DOMNode the SVG node
   */
  protected function getSvg(): DOMNode {
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
      $this->svg->setAttribute('opacity', $opacity);
    } else {
      $this->svg->removeAttribute('opacity');
    }
    return $this;
  }

  /**
   * Sets the width of the SVG image
   * 
   * @param  float $width
   * @return $this for a fluent interface
   */
  public function setWidth(float $width = null) {
    if ($width !== null) {
      $this->svg->setAttribute('width', $width.'px');
    } else {
      $this->svg->removeAttribute('width');
    }
    return $this;
  }
  public function getHtml(): string {
    return $this->doc->saveHTML($this->svg);
  }

}
