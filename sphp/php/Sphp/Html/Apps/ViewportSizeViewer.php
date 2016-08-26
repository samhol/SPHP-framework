<?php

/**
 * ViewportSizeViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractSimpleContainerTag as AbstractSimpleContainerTag;

/**
 * Class ViewportSizeViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ViewportSizeViewer extends AbstractSimpleContainerTag {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct("span");
    $this->cssClasses()
            ->lock("sphp-viewport-size-viewer");
  }

}
