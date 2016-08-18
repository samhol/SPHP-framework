<?php

/**
 * Dd.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class Models an HTML &lt;dd&gt; tag
 *
 * The {@link self} component is used to describe a term/name in a description list. 
 * The {@link self} component is used in conjunction with {@link Dl} (defines the 
 * definition list) and &lt;dt&gt; (defines the item in the list). Inside a {@link self} 
 * component you can put paragraphs, line breaks, images, links, lists, etc.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @link    http://www.w3schools.com/tags/tag_dd.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dd extends ContainerTag implements DlContentInterface {

  /**
   * Constructs a new instance
   *
   * @param  mixed $content the description
   */
  public function __construct($content = null) {
    parent::__construct("dd", $content);
  }

}
