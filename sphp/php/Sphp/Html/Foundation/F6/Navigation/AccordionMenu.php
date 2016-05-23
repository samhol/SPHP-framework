<?php

/**
 * SideNav.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation;

/**
 * Class implements Foundation 6 Accordion Menu in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @version 1.1.1
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/sidenav.html Foundation Side Nav
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AccordionMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param null|string|Heading $content the top most heading of the Foundation Side Nav
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock("vertical");
    $this->attrs()->demand("data-accordion-menu");
  }

  /**
   * Appends content to the component
   *
   * @param  SideNavItemInterface $content added content
   * @return self for PHP Method Chaining
   */
  public function append($content) {
    if ($content instanceof SubMenu) {
      $content->nested(true)->vertical(true);
    }
    parent::append($content);
    return $this;
  }

  /**
   * Appends a {@link Heading} row to the component
   *
   * @param  string $content the content of the heading row
   * @return self for PHP Method Chaining
   * @see    Heading
   */
  public function appendHeading($content) {
    $this->content()->append(new Heading($content));
    return $this;
  }

}
