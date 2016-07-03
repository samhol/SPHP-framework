<?php

/**
 * HyperlinkButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Class implements an HTML &lt;a&gt; tag as a Foundation Button in PHP
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-22
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkButton extends Hyperlink implements ButtonInterface {

  use ButtonTrait;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   * 
   * @param  string $href the URL of the hyperlink
   * @param  string $content link tag's content
   * @param  string $target the value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct($href, $content, $target);
    $this->cssClasses()->lock("button");
  }

}
