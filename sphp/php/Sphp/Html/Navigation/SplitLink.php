<?php

/**
 * SplitLink.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Span as Span;

/**
 * Class implements a Foundation Dropdown Button in PHP
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-22
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SplitLink extends Hyperlink {

  /**
   * Dropdown container
   *
   * @var span
   */
  private $split;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   *
   * @param  string $href the URL of the hyperlink
   * @param  string $content link tag's content
   * @param  string $target the value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct($href, $content, $target);
    $this->cssClasses()->lock("split");
    $this->split = new Span();
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->split);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->split = clone $this->split;
    parent::__clone();
  }

  /**
   * Returns the splitter component
   *
   * @return Span the splitter component
   */
  public function splitter() {
    return $this->split;
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->getOpeningTag() . $this->split . $this->content() . $this->getClosingTag();
  }

}
