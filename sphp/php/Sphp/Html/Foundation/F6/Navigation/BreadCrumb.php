<?php

/**
 * BreadCrumb.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation;

/**
 * Class Models an accessible menu item for Foundation 6 Breadcrumb component
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation 6 Breadcrumbs
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BreadCrumb extends MenuLink {

  /**
   * Constructs a new instance of the {@link self] component
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   *
   * @param  string $href the URL of the link
   * @param  string $content link tag's content
   * @param  string $target the value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct($href, $content, $target);
    //$this->lockAttr("role", "menuitem");
  }

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true foor activation and false for deactivation
   * @return self for PHP Method Chaining
   */
  public function setDisabled($active = true) {
    if ($active) {
      $this->addCssClass("disabled");
    } else {
      $this->removeCssClass("disabled");
    }
    return $this;
  }

  /**
   * Checks whether the hyperlink component is set as active or not
   *
   * @return boolean true if the hyperlink component is set as active,
   *         otherwise false
   */
  public function isDisabled() {
    return $this->hasCssClass("disabled");
  }

}
