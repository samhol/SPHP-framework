<?php

/**
 * SideNavViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

/**
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SideNavViewer implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var array 
   */
  private $data;
  private $currentPage;

  /**
   *
   * @var AccordionMenu 
   */
  private $nav;

  public function __construct($data, $currentPage = '') {
    $this->data = $data;
    $this->currentPage = $currentPage;
    $this->buildMenu();
  }

  /**
   * 
   * @return AccordionMenu
   */
  public function getMenu() {
    return $this->nav;
  }

  protected function buildMenu() {
    $this->nav = new AccordionMenu();
    $this->nav->appendText('Documentation');
    $builder = new MenuBuilder(new MenuLinkBuilder($this->currentPage));
    $builder->buildMenu($this->data, $this->nav);
  }

  public function getHtml(): string {
    return $this->nav->getHtml();
  }

}
