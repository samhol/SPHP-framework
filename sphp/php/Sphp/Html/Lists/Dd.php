<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;dd&gt; tag
 *
 * This component is used to describe a term/name ({@link Dt} object) in a description list.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_dd.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dd extends ContainerTag implements DlContent {

  /**
   * Constructor
   *
   * @param  null|mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct("dd", $content);
  }

}
