<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * The base class for all HTML tag components acting as HTML component containers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ContainerTag extends AbstractContainerTag {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a string
   * or to an array of strings. So also objects of any type that implement magic
   * method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content optional content of the component
   * @throws InvalidArgumentException if the tag name is not valid
   */
  public function __construct(string $tagName, $content = null) {
    parent::__construct($tagName);
    if ($content !== null) {
      $this->append($content);
    }
  }

}
