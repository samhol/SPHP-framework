<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;figcaption&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_figcaption.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FigCaption extends ContainerTag {

  /**
   * Constructor
   *
   * @param  mixed $caption the caption content
   */
  public function __construct($caption = null) {
    parent::__construct('figcaption', $caption);
  }

}
