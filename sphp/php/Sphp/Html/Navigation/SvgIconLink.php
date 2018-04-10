<?php

/**
 * AbstractIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractComponent;

/**
 * Abstract Implementation of an icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SvgIconLink extends AbstractComponent implements HyperlinkInterface {

  use HyperlinkTrait;

  private $svg;

  /**
   * @var string 
   */
  private $sreenreaderText;

  /**
   * Constructs a new instances
   * 
   * @param  string $svg the SVG source for the icon
   */
  public function __construct(string $svg) {
    parent::__construct('a');
    $this->svg = $svg;
    //$this->attributes()->set('aria-hidden', 'true');
  }

  /**
   * 
   * @param  string $sreenreaderText 
   * @return $this for a fluent interface
   */
  public function setSreenreaderText(string $sreenreaderText = null) {
    $this->sreenreaderText = $sreenreaderText;
    return $this;
  }

  public function contentToString(): string {
    $output = $this->svg;
    if ($this->sreenreaderText !== null) {
      $output .= Factory::screenReaderLabel($this->sreenreaderText);
    }
    return $output;
  }

}
