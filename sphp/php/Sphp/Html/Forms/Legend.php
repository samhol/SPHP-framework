<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML legend tag
 *
 * **Note:** The legend element represents a caption for the rest of the
 * contents of the legend element's parent fieldset element, if any.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_legend.asp w3schools HTML API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-legend-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Legend extends ContainerTag {

  /**
   * Constructor
   *
   * @param string $content legend content
   */
  public function __construct($content = null) {
    parent::__construct('legend', $content);
  }

}
