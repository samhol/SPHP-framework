<?php

/**
 * Badge.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;

/**
 * Implements a Foundation Badge
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Badge extends AbstractComponent {

  private $content;

  public function __construct($content = null) {
    parent::__construct('span');
    $this->cssClasses()->lock('badge');
    if ($content !== null) {
      $this->content = $content;
    }
  }

  public function contentToString(): string {
    return "$this->content";
  }

}
