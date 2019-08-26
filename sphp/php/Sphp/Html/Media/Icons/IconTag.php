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
class IconTag extends AbstractIconTag {

  /**
   * Constructor
   * 
   * @param  string $iconName
   * @param  string $tagName the tag name of the component
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $iconName, string $tagName = 'i') {
    parent::__construct($tagName);
    $this->cssClasses()->protectValue($iconName);
  }

  public static function __callStatic(string $name, array $arguments): IconTag {
    $icon = new self($arguments[0], $name);

    $iconClasses = array_shift($arguments);
    if ($iconClasses !== null) {
      $icon->cssClasses()->protectValue($iconClasses);
    }
    $screenReaderText = array_shift($arguments);
    if ($screenReaderText !== null) {
      $icon->setAriaLabel($screenReaderText);
    }
    return $icon;
  }

}
