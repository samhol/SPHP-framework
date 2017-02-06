<?php

namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
use Sphp\Html\Foundation\Sites\Navigation\Factory;

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
    Factory::buildMenu($this->data, $this->nav);
  }

  public function getHtml() {
    return $this->nav->getHtml();
  }

}
