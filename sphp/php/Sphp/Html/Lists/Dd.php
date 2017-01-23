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
 * This component is used to describe a term/name ({@link Dt} object) in a description list.
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
   * @param  null|mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct("dd", $content);
  }

}
