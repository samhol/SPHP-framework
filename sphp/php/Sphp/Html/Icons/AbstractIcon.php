<?php

/**
 * AbstractIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\EmptyTag;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Abstract Implementation of an icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractIcon extends EmptyTag {

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

}
