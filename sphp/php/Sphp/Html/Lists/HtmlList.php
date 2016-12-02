<?php

/**
 * HtmlList.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\WrappingContainer;
use Sphp\Core\Types\URL;

/**
 * Abstract class defines common features for both ordered and unordered HTML-list
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @link http://www.w3schools.com/html/html_lists.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class HtmlList extends AbstractContainerTag {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * 1. Any `mixed $content` not implementing {@link LiInterface} is wrapped 
   *    within {@link Li} component
   * 
   * @param  string $tagname the tagname of the component ('ul'|'ol')
   * @param  mixed|null $content optional content of the component
   */
  public function __construct($tagName, AttributeManager $attrManager = null, WrappingContainer $contentContainer = null) {
    if ($contentContainer === null) {
      $wrapper = function ($li) {
        if (!($li instanceof LiInterface)) {
          return new Li($li);
        } else {
          return $li;
        }
      };
      $contentContainer = new WrappingContainer($wrapper);
    }
    parent::__construct($tagName, $attrManager, $contentContainer);
  }

  /**
   * Appends {@link HyperlinkListItem} link object to the list
   *
   * @param  string|URL $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink($href, $content = '', $target = '_self') {
    return $this->append(new HyperlinkListItem($href, $content, $target));
  }

}
