<?php

/**
 * Footer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Flow;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;footer&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_footer.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Footer extends ContainerTag {

  use ContentCreatorTrait;

  /**
   * Constructs a new instance
   * 
   * @param  mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('footer', $content);
  }

}
