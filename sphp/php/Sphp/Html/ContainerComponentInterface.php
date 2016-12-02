<?php

/**
 * ContainerComponentInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Defines the properties required from a HTML component acting as a traversable component container
 *
 * **Notes:**
 *
 * Any class extending {@link self} follows these rules:
 * 
 * 1. Any extending class act as a container for other components like 
 *    {@link ContentInterface}, other objects, text, ...etc.
 * 2. The type of the content in such container depends solely on the container's 
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's {@link \ArrayAccess} 
 *    notation.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ContainerComponentInterface extends ComponentInterface, ContainerInterface {

}
