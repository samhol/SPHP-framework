<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use DOMDocument;

/**
 * Implements a Crossbones SVG image object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Crossbones extends Svg {

  public function __construct() {
    $doc = new DOMDocument();
    $doc->load('/home/int48291/public_html/playground/manual/svg/crossbones.svg');
    parent::__construct($doc);
  }

  public function setOpacity(float $opacity = null) {
    $graphs = $this->getSvg()->getElementsByTagName('g');
    foreach ($graphs as $g) {
      if ($opacity !== null) {
        $g->setAttribute('opacity', $opacity);
      } else {
        $g->removeAttribute('opacity');
      }
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
    $textElement->setAttribute('style', 'stroke: #f44; stroke-width:8px;fill:#000;font-family:Arial,Helvetica;font-size:70px;');
    $textElement->setAttribute('x', '50%');
    $textElement->setAttribute('y', '50%');
    $textElement->setAttribute('dominant-baseline', 'middle');
    $textElement->setAttribute('text-anchor', 'middle');
    $this->getSvg()->appendChild($textElement);
    return $this;
  }

}
