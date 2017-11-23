<?php

/**
 * Article.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Content;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;article&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Article extends ContainerTag {

  use ContentCreatorTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('article');
  }

}
