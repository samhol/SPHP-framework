<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\EmptyTag;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Abstract Implementation of an icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractIconTag extends EmptyTag implements Icon {

  /**
   * Constructor
   * 
   * @param  string $tagName the tag name of the component
   * @param  HtmlAttributeManager $attrManager
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $tagName = 'i', HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, true, $attrManager);
  }

  /**
   * 
   * @param  bool $decorative
   * @return $this for a fluent interface
   */
  public function setDecorative(bool $decorative = null) {
    if ($decorative === true) {
      $this->attributes()->setAttribute('aria-hidden', 'true');
      $this->attributes()->remove('aria-label');
    } else {
      $this->removeAttribute('aria-hidden');
    }
    return $this;
  }

  public function setTitle(string $title = null) {
    $this->attributes()->setAria('label', $title);
    $this->attributes()->setAttribute('title', $title);
    if ($title !== null) {
      $this->attributes()->remove('aria-hidden');
    }
    return $this;
  }

}
