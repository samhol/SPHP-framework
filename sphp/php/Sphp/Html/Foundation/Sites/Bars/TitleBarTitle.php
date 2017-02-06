<?php

/**
 * TitleBarTitle.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\SimpleContainerTag;

/**
 * Implements a Title area for a Title Bar component
 *
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/kitchen-sink.html#title-bar Foundation Title Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleBarTitle extends SimpleContainerTag {

  public function __construct($content = null) {
    parent::__construct('span', $content);
    $this->cssClasses()->lock('title-bar-title');
  }

}
