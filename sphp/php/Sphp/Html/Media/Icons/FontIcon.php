<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FontIcon extends AbstractIcon {

  /**
   * Constructor
   * 
   * @param string|string[] $classes the icon name
   * @param string $screenreaderLabel
   */
  public function __construct($classes, string $screenreaderLabel = null) {
    parent::__construct('i');
    $this->cssClasses()->protectValue($classes);
    $this->setAriaLabel($screenreaderLabel);
  }

}
