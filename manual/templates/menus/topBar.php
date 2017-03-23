<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Bars\TopBar;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

try {
  ob_start();
  $navi = new TopBar();
  $navi->addCssClass('sphp-manual');

  //$manual = (new SubMenu('Documentation'));

  $leftDrop = new DropdownMenu();
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($_SERVER["REDIRECT_URL"], '/')));
  $leftDrop->appendSubMenu($builder->buildSub($manualLinks));
  $leftDrop->appendSubMenu($builder->buildSub($dependenciesLinks));
  $leftDrop->appendSubMenu($builder->buildSub($externalApiLinks));
  $navi->left()->setContent($leftDrop);
  /* $packages = (new SubMenu('Dependencies'))
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

    $navi->right()->append($packages); */

  $navi->printHtml();

  unset($navi, $apis, $packages, $topbarsubmenu, $phpDepMenu, $jsDepMenu);
  $content = ob_get_contents();
} catch (\Exception $e) {
  $content .= new ExceptionBox($e);
}
ob_end_clean();
echo $content;
unset($content);
