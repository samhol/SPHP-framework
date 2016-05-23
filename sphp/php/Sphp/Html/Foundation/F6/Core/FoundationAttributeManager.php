<?php

/**
 * AttributeManager.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Attributes\AttributeManager as AttributeManager;
use Sphp\Html\Attributes\PropertyAttribute as PropertyAttribute;

/**
 * Class contains and manages all the attribute value pairs for a markup language tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FoundationAttributeManager extends AttributeManager {

  /**
   * Constructs a new instance
   *
   */
  public function __construct(array $objectMap = []) {
    $objectMap[] = new PropertyAttribute("data-options");
    parent::__construct($objectMap);
  }

  /**
   * Returns the 'data-option' attribute object
   *
   * @return PropertyAttribute the 'data-option' attribute object
   */
  public function dataOptions() {
    return $this->getAttributeObject("data-options");
  }

}
