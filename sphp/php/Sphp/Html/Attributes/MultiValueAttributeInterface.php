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
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MultiValueAttributeInterface extends LockableAttributeInterface, Countable, Traversable, Arrayable {
  
}
