<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\SVG;

use Sphp\Html\AbstractContent;
use DOMDocument;
use DOMNode;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use libXMLError;

/**
 * Implements an SVG image object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Svg extends AbstractContent {

  private DOMDocument $doc;
  private DOMNode $svg;

  /**
   * Constructor
   * 
   * @param DOMDocument $doc
   */
  public function __construct(DOMDocument $doc) {
    $this->doc = $doc;
    $svg = $doc->getElementsByTagName('svg');
    if ($svg->count() === 0) {
      throw new InvalidArgumentException("Invalid SVG document provided");
    }
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
   * @param  string|null $title
   * @return $this for a fluent interface
   */
  public function setTitle(?string $title = null) {
    if ($title !== null) {
      $titleNode = $this->doc->getElementsByTagName('title')->item(0);
      $this->doc->documentElement;
      if ($titleNode === null) {
        $titleNode = $this->doc->createElement('title');
        $this->svg->insertBefore($titleNode, $this->svg->firstChild);
      }
      $titleNode->textContent = $title;
    } else {
      $titles = $this->doc->getElementsByTagName('title');
      foreach ($titles as $title) {
        $this->doc->documentElement->removeChild($title);
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
  public function setOpacity(?float $opacity = null) {
    if ($opacity !== null) {
      $this->svg->setAttribute('opacity', (string) $opacity);
    } else {
      $this->svg->removeAttribute('opacity');
    }
    return $this;
  }

  /**
   * 
   * @param  string $color
   * @param  float $width
   * @return $this for a fluent interface
   */
  public function setStroke(string $color, float $width) {
    $graphs = $this->getSvg()->getElementsByTagName('g');
    foreach ($graphs as $g) {
      $g->setAttribute('stroke', $color);
      $g->setAttribute('stroke-width', (string) $width);
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

  public function getHtml(): string {
    return $this->doc->saveHTML($this->svg);
  }

  /**
   * Returns a new SVG image object instance created from a file
   * 
   * @param  string $file
   * @return Svg new instance
   * @throws FileSystemException if the file cannot be found or is not valid SVG file
   */
  public static function fileToObject(string $file): Svg {
    if (!is_file($file)) {
      throw new FileSystemException("SVG file '$file' is not found");
    }
    $doc = new DOMDocument();
    $old = libxml_use_internal_errors(true);
    $loaded = $doc->load($file);
    if (!$loaded) {
      $errors = libxml_get_errors();
      libxml_clear_errors();
      libxml_use_internal_errors($old);
      foreach ($errors as $error) {
        throw new InvalidArgumentException($error->message, $error->level);
      }
    }
    return new Svg($doc);
  }

  /**
   * Returns a new SVG image object instance created from a string
   * 
   * @param  string $source The string containing the SVG
   * @return Svg new instance
   * @throws InvalidArgumentException if the input string is not valid SVG
   */
  public static function stringToSvg(string $source): Svg {
    $old = libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $loaded = $doc->loadXML($source);
    if (!$loaded) {
      $errors = libxml_get_errors();
      libxml_clear_errors();
      libxml_use_internal_errors($old);
      foreach ($errors as $error) {
        throw new InvalidArgumentException($error->message, $error->level);
      }
    }
    return new Svg($doc);
  }

}
