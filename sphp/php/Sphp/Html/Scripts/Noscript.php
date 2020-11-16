<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use Sphp\Html\ContainerTag;
use Sphp\Html\Head\MetaData;

/**
 * Implementation of an HTML noscript tag
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_noscript.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Noscript extends ContainerTag implements MetaData {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param  null|mixed $content the content of the component
   */
  public function __construct($content = null) {
    parent::__construct('noscript', $content);
  }

  public function getHash(): string {
    return spl_object_hash($this);
  }

}
