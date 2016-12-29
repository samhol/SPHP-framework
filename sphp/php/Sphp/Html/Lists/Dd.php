<?php

/**
 * Dd.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;dd&gt; tag
 *
 * This component is used to describe a term/name in a description list. It is 
 * used in conjunction with {@link Dl} (definition list) and {@link Dt} (the 
 * item in the list).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @link    http://www.w3schools.com/tags/tag_dd.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dd extends ContainerTag implements DlContentInterface {

  /**
   * Constructs a new instance
   *
   * @param  mixed $content the content or `null` for no content
   */
  public function __construct($content = null) {
    parent::__construct("dd", $content);
  }

}
