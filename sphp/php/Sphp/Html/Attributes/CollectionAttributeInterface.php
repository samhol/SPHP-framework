<?php

/**
 * MultiValueAttributeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines an HTML attribute with multiple values value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CollectionAttributeInterface extends MutableAttributeInterface, Countable, Traversable, Arrayable {
  
}
