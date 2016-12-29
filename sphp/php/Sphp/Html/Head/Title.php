<?php

/**
 * Title.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\SimpleContainerTag;

/**
 * Implements an HTML &lt;title&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_title.asp w3schools HTML API
 * @filesource
 */
class Title extends SimpleContainerTag implements HeadComponentInterface {

  /**
   * Constructs a new instance
   *
   * @param string $content tag's content
   */
  public function __construct($content = null) {
    parent::__construct('title');
    $this->setContent($content);
  }

}
