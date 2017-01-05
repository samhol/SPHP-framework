<?php

namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
use Sphp\Html\Foundation\Sites\Navigation\Factory;
use Sphp\Core\Path;
use Sphp\Html\Foundation\Sites\Navigation\SubMenu;
use Sphp\Html\Foundation\Sites\Navigation\MenuLink;

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
    /* foreach ($this->data as $item) {
      if (array_key_exists('link', $item)) {
      $this->nav->append($this->createLink($item));
      } else if (array_key_exists('sub', $item) && array_key_exists("links", $item)) {
      $this->nav->append($this->buildSub($item['sub'], $item['links']));
      }
      } */
  }

  public function getHtml() {
    return $this->nav->getHtml();
  }

}
