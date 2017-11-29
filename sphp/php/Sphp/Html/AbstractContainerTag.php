<?php

/**
 * AbstractContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * All containers follow these rules:
 *
 * 1. Any extending class act as a container for other HTML components.
 * 2. The type of the content depends solely on the container's
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's {@link \ArrayAccess}
 *    notation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractContainerTag extends AbstractContainerComponent implements IteratorAggregate, ContainerComponentInterface, ContentParser {

  use ContainerComponentTrait,
      ContentParsingTrait,
      TraversableTrait;
}
