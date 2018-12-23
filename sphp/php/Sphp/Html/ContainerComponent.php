<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

/**
 * Defines the properties required from a HTML component acting as a traversable component container
 *
 * **Notes:**
 *
 * Any extending class follows these rules:
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
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface ContainerComponent extends Component, Container {
  
}
