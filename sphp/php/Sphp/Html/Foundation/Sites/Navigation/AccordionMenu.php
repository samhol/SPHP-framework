<?php

/**
 * SideNav.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements Foundation 6 Accordion Menu in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
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
    $this->cssClasses()->lock('vertical');
    $this->attrs()->demand('data-accordion-menu');
  }

  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->nested(true)->vertical(true);
    }
    parent::append($content);
    return $this;
  }

}
