<?php

namespace Sphp\Html\Foundation\F6\Navigation\TopBar;

use Sphp\Core\Configuration as Config;
use Sphp\Html\Foundation\F6\Navigation\SubMenu as SubMenu;
use Sphp\Html\Foundation\F6\Core\BlockGrid as BlockGrid;
use Sphp\Html\Foundation\F6\Containers\Dropdown as Dropdown;

include_once 'links.php';
try {
  ob_start();
  $appConf = Config::useDomain("manual");
  $navi = (new TopBar())
          ->addCssClass("sphp-manual");

  $manual = (new SubMenu("Documentation"));

  $topbarMenuLinker = function (array $link, $menu) {
    if (array_key_exists("href", $link)) {
      $text = array_key_exists("text", $link) ? $link["text"] : $link["href"];
      $target = array_key_exists("target", $link) ? $link["target"] : "_self";
      $menu->appendLink($link["href"], $text, $target);
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
  foreach (Config::current()->get("MANUAL_LINKS") as $item) {
    if (array_key_exists("href", $item)) {
      $topbarMenuLinker($item, $manual);
    } else if (array_key_exists("separator", $item)) {
      $separatorCreator($item, $manual);
    } else if (array_key_exists("group", $item) && array_key_exists("sub", $item)) {
      $topbarsubmenu($item, $manual);
    }
  }

  $navi->left()->append($manual);
  $apis = (new SubMenu("API Docs"))
          ->appendText("PHP:")
          ->appendLink($appConf->get("apigen"), "ApiGen API", "apigen")
          ->appendText("Javascript:")
          ->appendLink($appConf->get("jsdoc"), "JsDoc API", "jsdoc");
  $navi->left()->append($apis);

 /* $packages = (new SubMenu("Requirements"))
          ->appendText("PHP resources:")
          ->append((new SubMenu("External PHP Libraries"))
          //->appendLabel("Symfony components:", false)
          //->appendLink("http://symfony.com/doc/current/components/class_loader/", "Class Loader")
          //->appendLink("http://symfony.com/doc/current/components/dependency_injection/", "Dependency Injection")
          //->appendLabel("Other libraries:")
          ->appendLink("https://github.com/erusev/parsedown-extra", "Parsedown Extra")
          ->appendLink("http://qbnz.com/highlighter/", "GeSHi")
          ->appendLink("http://github.com/jdorn/sql-formatter", "SQL Formatter")
          ->appendLink("https://github.com/raulferras/PHP-po-parser", "Po Parser")
          ->appendLink("https://imagine.readthedocs.org", "Imagine"));


  $packages
          ->appendText("JS resources:")
          ->appendLink("http://modernizr.com/", "Modernizr")
          ->appendLink("https://github.com/ftlabs/fastclick", "FastClick");

  $clientSideMenu = new SubMenu("jQuery related:");
  $clientSideMenu->appendLink("http://jquery.com/", "jQuery.com")
          ->appendText("jQuery plugins:")
          ->appendLink("http://foundation.zurb.com/", "Foundation")
          ->appendLink("http://qtip2.com/", "qTip 2")
          ->appendLink("http://ressio.github.io/lazy-load-xt/", "Lazy Load XT")
          ->appendLink("http://zeroclipboard.org/", "ZeroClipboard")
          ->appendLink("http://www.ama3.com/anytime/", "Any+Time&trade; DatePicker");
  $packages->append($clientSideMenu);*/

  //$navi->left()->append($packages);

//  $github = (new SplitLink("https://github.com/samhol/SPH-framework", "GitHub", "_blank"))->addCssClass("sphp-github-button");
  //$navi->right()->append($github);
  $depContainer = new BlockGrid(null, 2);

  $phpDepMenu = (new \Sphp\Html\Foundation\F6\Navigation\Menu())
          ->vertical()
          ->appendText("PHP")
          ->appendLink("https://github.com/erusev/parsedown-extra", "Parsedown Extra")
          ->appendLink("http://qbnz.com/highlighter/", "GeSHi")
          ->appendLink("http://github.com/jdorn/sql-formatter", "SQL Formatter")
          ->appendLink("https://github.com/raulferras/PHP-po-parser", "Po Parser")
          ->appendLink("https://imagine.readthedocs.org", "Imagine");
  $depContainer->append($phpDepMenu);
 
  $jsDepMenu = (new \Sphp\Html\Foundation\F6\Navigation\Menu())
          ->appendText("JavaScript")
          ->vertical()
          //->appendText("jQuery related", TRUE)
          ->appendLink("http://jquery.com/", "jQuery.com", "_blank")
          ->appendLink("http://foundation.zurb.com/", "Foundation")
          ->appendLink("http://qtip2.com/", "qTip 2")
          ->appendLink("http://ressio.github.io/lazy-load-xt/", "Lazy Load XT")
          ->appendLink("http://zeroclipboard.org/", "ZeroClipboard")
          ->appendLink("http://www.ama3.com/anytime/", "Any+Time&trade; DatePicker");

  $depContainer->append($jsDepMenu);
  
  $depDropdown = (new Dropdown("Dependencies", $depContainer))
          ->closeOnBodyClick(true)
          ->align("bottom")
          ->float("right")
          ->setSize("large");
  $navi->right()->append($depDropdown);
  $navi->printHtml();

  unset($navi, $apis, $packages, $topbarsubmenu, $phpDepMenu, $jsDepMenu);
  $content = ob_get_contents();
} catch (\Exception $e) {
  $content .= new ExceptionBox($e);
}
ob_end_clean();
echo $content;
unset($content);
?>
