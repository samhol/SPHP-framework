<?php

/**
 * Dt.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;dt&gt; tag
 *
 * This component defines an term in an HTML definition list. It is used in 
 * conjunction with its definitions {@link Dd}
 * 
 * This component can contain HTML with paragraphs, line breaks, 
 * images, links, lists, etc and/or components implementing these HTML 
 * elements.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @link    http://www.w3schools.com/tags/tag_dt.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dt extends ContainerTag implements DlContentInterface {

  /**
   * Constructs a new instance
   * 
   * @param  null|mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct("dt", $content);
  }

}
