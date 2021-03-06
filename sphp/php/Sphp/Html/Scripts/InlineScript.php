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

use Sphp\Html\SimpleTag;

/**
 * Implementation of an HTML script tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component contains scripting statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InlineScript extends SimpleTag implements Script {

  /**
   * Constructor
   * 
   * **IMPORTANT:** 
   * 
   * This component contains scripting statements
   *
   * @param string $code the script code inside the script component or `null` for empty
   */
  public function __construct(string $code = null) {
    parent::__construct('script', $code);
  }

  public function getHash(): string {
    return spl_object_hash($this);
  }

}
