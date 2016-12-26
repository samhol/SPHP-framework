<?php

namespace Sphp\Manual\MVC;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Navigation\AccordionMenu;
use Sphp\Core\Path;
use Sphp\Html\Foundation\Sites\Navigation\SubMenu;

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
    $this->nav = new AccordionMenu();
  }

  private function parseHref(array $link) {
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

  private function parseTarget(array $link) {
    return array_key_exists('target', $link) ? $link['target'] : '_self';
  }

  private function sidenavLinker(array $link) {
    if (array_key_exists('link', $link)) {
      $href = $this->parseHref($link);
      $target = $this->parseTarget($link);
      $this->nav->appendLink($href, $link['link'], $target);
    }
  }

  private function buildNav() {
    foreach ($this->data['root'] as $item) {
      if (array_key_exists('link', $item)) {
        $sidenavLinker($item);
      } else if (array_key_exists('sub', $item) && array_key_exists("links", $item)) {
        $accordion = new SubMenu($item['sub']);
        foreach ($item['links'] as $link) {
          if (array_key_exists('link', $link)) {
            $href = $this->parseHref($link);
            $target = $this->parseTarget($link);
            $accordion->appendLink($href, $link['link'], $target);
          }
        }
        $this->nav->append($accordion);
      }
    }
  }

  public function getHtml() {
    $links = $this->data;
    $this->nav->addCssClass('')->appendText('Documentation');
    $this->nav[0]->addCssClass('heading');
    $sidenavLinker = function (array $link) {
      if (array_key_exists('link', $link)) {
        $href = $this->parseHref($link);
        $target = $this->parseTarget($link);
        $this->nav->appendLink($href, $link['link'], $target);
      }
    };

    foreach ($links['root'] as $item) {
      if (array_key_exists('link', $item)) {
        $sidenavLinker($item);
      } else if (array_key_exists('sub', $item) && array_key_exists("links", $item)) {
        $accordion = new SubMenu($item['sub']);
        foreach ($item['links'] as $link) {
          if (array_key_exists('link', $link)) {
            $href = $this->parseHref($link);
            $target = $this->parseTarget($link);
            $accordion->appendLink($href, $link['link'], $target);
          }
        }
        $this->nav->append($accordion);
      }
    }

    return $this->nav->getHtml();
  }

}
