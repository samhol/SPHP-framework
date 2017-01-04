<?php

namespace Sphp\Manual\MVC;

use Sphp\Core\Configuration;
use Sphp\Html\Foundation\Sites\Navigation\SubMenu as SubMenu;
use Sphp\Html\Foundation\Sites\Navigation\TopBar;
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
   * @var TopBar 
   */
  private $topBar;

  public function __construct($data, $currentPage = '') {
    $this->topBar = new TopBar;
    $this->data = $data;
    $this->currentPage = $currentPage;
    $this->buildMenu();
  }
    protected function buildMenu() {
    
    $this->topBar->addCssClass('sphp-manual');
    $this->topBar->left()->append(Factory::buildMenu($this->data['manual'],  new SubMenu('Documentation')));

    /*foreach ($this->data as $item) {
      if (array_key_exists('link', $item)) {
        $this->nav->append($this->createLink($item));
      } else if (array_key_exists('sub', $item) && array_key_exists("links", $item)) {
        $this->nav->append($this->buildSub($item['sub'], $item['links']));
      }
    }*/
  }

  public function getHtml() {
    return $this->topBar->getHtml();
  }
}
try {
  ob_start();
  $appConf = Configuration::useDomain('manual');
  $navi = (new TopBar())
          ->addCssClass('sphp-manual');

  $manual = (new SubMenu('Documentation'));

  $topbarMenuLinker = function (array $link, $menu) {
    if (array_key_exists('href', $link)) {
      $text = array_key_exists('text', $link) ? $link['text'] : $link['href'];
      $target = array_key_exists('target', $link) ? $link['target'] : '_self';
      $menu->appendLink($link['href'], $text, $target);
    }
  };
  $separatorCreator = function ($separator, SubMenu $menu) {
    $menu->appendText($separator, true);
  };
  $topbarsubmenu = function (array $data, SubMenu $parent) use ($topbarMenuLinker) {
    $menu = new SubMenu($data["group"]);
    foreach ($data["sub"] as $link) {
      $topbarMenuLinker($link, $menu);
    }
    $parent->append($menu);
  };
  foreach (Configuration::current()->get('MANUAL_LINKS') as $item) {
    if (array_key_exists('href', $item)) {
      $topbarMenuLinker($item, $manual);
    } else if (array_key_exists('separator', $item)) {
      $separatorCreator($item, $manual);
    } else if (array_key_exists('group', $item) && array_key_exists('sub', $item)) {
      $topbarsubmenu($item, $manual);
    }
  }

  $navi->left()->append($manual);
  $apis = (new SubMenu('API Docs'))
          ->appendText('PHP:')
          ->appendLink($appConf->get('apigen'), 'ApiGen API', 'apigen')
          ->appendText('Javascript:')
          ->appendLink($appConf->get('jsdoc'), 'JsDoc API', 'jsdoc');
  $navi->left()->append($apis);

  $packages = (new SubMenu('Dependencies'))
          ->appendText('PHP resources:')
          ->appendLink('http://php.net/', 'PHP 5.6', '_blank')
          ->append((new SubMenu("External PHP Libraries"))
          ->appendLink('https://github.com/erusev/parsedown-extra', 'Parsedown Extra', '_blank')
          ->appendLink('http://qbnz.com/highlighter/', 'GeSHi', '_blank')
          ->appendLink('http://github.com/jdorn/sql-formatter', 'SQL Formatter', '_blank')
          ->appendLink('https://github.com/raulferras/PHP-po-parser', "Po Parser", '_blank')
          ->appendLink('https://imagine.readthedocs.org', "Imagine", '_blank'));

  $packages
          ->appendText('JS resources:')
          ->appendLink('http://jquery.com/', "jQuery 1.11", '_blank')
          ->appendLink('http://foundation.zurb.com/', 'Foundation', '_blank');
  $clientSideMenu = new SubMenu('jQuery plugins:');
  $clientSideMenu->appendLink('http://qtip2.com/', 'qTip 2', '_blank')
          ->appendLink('http://ressio.github.io/lazy-load-xt/', 'Lazy Load XT', '_blank')
          ->appendLink('http://www.ama3.com/anytime/', 'Any+Time&trade; DatePicker', '_blank');
  $packages->append($clientSideMenu)
          ->appendLink('http://zeroclipboard.org/', 'ZeroClipboard', '_blank');

  $navi->right()->append($packages);

  $navi->printHtml();

  unset($navi, $apis, $packages, $topbarsubmenu, $phpDepMenu, $jsDepMenu);
  $content = ob_get_contents();
} catch (\Exception $e) {
  $content .= new ExceptionBox($e);
}
ob_end_clean();
echo $content;
unset($content);

