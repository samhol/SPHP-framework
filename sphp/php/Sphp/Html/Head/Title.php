<?php

/**
 * Title.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\SimpleContainerTag as SimpleContainerTag;

/**
 * Class models an HTML &lt;title&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_title.asp w3schools HTML API link
 * @filesource
 */
class Title extends SimpleContainerTag implements MetaDataInterface {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "title";

  /**
   * Constructs a new instance
   *
   * @param  string $content tag's content
   */
  public function __construct($content = null) {
    parent::__construct(self::TAG_NAME);
    $this->setContent($content);
  }

}
