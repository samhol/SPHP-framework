<?php

/**
 * Page.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

/**
 * Implements a page button for a Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Page extends AbstractPage {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $href the URL of the link
   * @param  string|null $content the content of the page link
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(string $href = null, $content = null, string $target = null) {
    parent::__construct($href, $content, $target);
  }

}
