<?php

/**
 * MenuLink.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Lists\HyperlinkListItem as HyperlinkListItem;
use Sphp\Core\Types\URL;

/**
 * Class Models a hyperlink component for the Dropown menu component
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/docs/components/subnav.html Foundation Sub Nav
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuLink extends HyperlinkListItem implements MenuItemInterface {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  string $href the URL of the link
   * @param  string $content link tag's content
   * @param  string $target the value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = '', $content = null, $target = '_self') {
    parent::__construct($href, $content, $target);
  }

  public function setHref($href, $encode = true) {
   // echo "$href";
    $url = new URL($href);
   // echo "$url";
    if ($url->isCurrent()) {
      $this->setActive(true);
    } else {
      $this->setActive(false);
    }
    parent::setHref($url, $encode);
    return $this;
  }

  /**
   * Sets the hyperlink component as active if the URL matches with the
   *  current URL of the page
   *
   * @return self for PHP Method Chaining
   */
  public function activate() {
    if ($this->urlEquals(URL::getCurrent())) {
      $this->setActive(true);
    } else {
      $this->setActive(false);
    }
    return $this;
  }

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true) {
    if ($active) {
      $this->addCssClass('active');
    } else {
      $this->removeCssClass('active');
    }
    return $this;
  }

  /**
   * Checks whether the hyperlink component is set as active or not
   *
   * @return boolean true if the hyperlink component is set as active, otherwise false
   */
  public function isActive() {
    return $this->hasCssClass("active");
  }

}
