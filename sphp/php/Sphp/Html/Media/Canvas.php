<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML canvas tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_canvas.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-canvas-element W3C API
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Canvas extends EmptyTag implements SizeableMedia {

  use SizeableMediaTrait;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('canvas');
  }

}
