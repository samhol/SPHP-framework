<?php

/**
 * MenuLinkBuilder.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */
namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

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
    $this->nav->addCssClass('')->appendText('Documentation');
    $builder = new MenuBuilder(new MenuLinkBuilder($this->currentPage));
    $builder->buildMenu($this->data, $this->nav);
  }

  public function getHtml() {
    return $this->nav->getHtml();
  }

}
