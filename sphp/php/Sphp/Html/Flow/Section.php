<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Flow;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;section&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_section.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Section extends ContainerTag {

  use ContentCreatorTrait;

  /**
   * Constructs a new instance
   * 
   * @param  mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('section', $content);
  }

}
