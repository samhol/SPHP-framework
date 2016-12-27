<?php

namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
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

  /**
   *
   * @var AccordionMenu 
   */
  private $nav;

  public function __construct($data) {
    $this->data = $data;
    $this->buildMenu();
  }

  protected function parseHref(array $link) {
    if (array_key_exists('url', $link)) {
      $href = $link['url'];
    } else {
      $href = Path::get()->http();
      if (array_key_exists('page', $link)) {
        $href .= '?page=' . $link['page'];
      }
    }
    return $href;
  }

  protected function parseTarget(array $link) {
    return array_key_exists('target', $link) ? $link['target'] : '_self';
  }

  /**
   * 
   * @param  array $link
   * @return MenuLink
   */
  protected function createLink(array $link) {
    $href = $this->parseHref($link);
    $target = $this->parseTarget($link);
    return new MenuLink($href, $link['link'], $target);
  }

  /**
   * 
   * @param string $root
   * @param array $sub
   * @return SubMenu
   */
  protected function buildSub($root, array $sub) {
    $accordion = new SubMenu($root);
    foreach ($sub as $link) {
      if (array_key_exists('link', $link)) {
        $accordion->append($this->createLink($link));
      }
    }
    return $accordion;
  }

  protected function buildMenu() {
    $this->nav = new AccordionMenu();
    $this->nav->addCssClass('')->appendText('Documentation');
    foreach ($this->data['root'] as $item) {
      if (array_key_exists('link', $item)) {
        $this->nav->append($this->createLink($item));
      } else if (array_key_exists('sub', $item) && array_key_exists("links", $item)) {
        $this->nav->append($this->buildSub($item['sub'], $item['links']));
      }
    }
  }

  public function getHtml() {
    return $this->nav->getHtml();
  }

}
