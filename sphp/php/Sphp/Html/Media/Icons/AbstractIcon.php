<?php

/**
 * AbstractIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\EmptyTag;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Foundation\Sites\Core\Factory;

/**
 * Abstract Implementation of an icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractIcon extends EmptyTag implements IconInterface {

  /**
   * @var string 
   */
  private $sreenreaderLabel;

  /**
   * Constructs a new instances
   * 
   * @param  string $tagName the tag name of the component
   * @param  HtmlAttributeManager $attrManager
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $tagName = 'i', HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, true, $attrManager);
    $this->attributes()->set('aria-hidden', 'true');
  }

  public function setSreenreaderText(string $sreenreaderLabel = null) {
    $this->sreenreaderLabel = $sreenreaderLabel;
    return $this;
  }

  public function getHtml(): string {
    $output = parent::getHtml();
    if ($this->sreenreaderLabel !== null) {
      $output .= Factory::screenReaderLabel($this->sreenreaderLabel);
    }
    return $output;
  }

}
