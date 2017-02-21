<?php

/**
 * FoundationDocsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Hyperlink;
use Sphp\Stdlib\Strings;
use Sphp\Html\Foundation\Sites\Containers\OffCanvas\OffCanvas;
use Sphp\Html\Foundation\Sites\Grids\GridInterface;

/**
 * Hyperlink generator pointing to online Foundation Docs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FoundationDocsLinker extends AbstractLinker {

  /**
   *
   * @var self
   */
  private static $instance;

  /**
   * component map
   *
   * @var string[][] 
   */
  private static $componentMap = [
      \Sphp\Html\Foundation\Navigation\SubNav\SubNav::class => ['subnav', 'Sub Nav'],
      \Sphp\Html\Foundation\Navigation\TopBar\TopBar::class => ['topbar', 'Top Bar'],
      GridInterface::class => ["grid", "Grid"],
      \Sphp\Html\Foundation\Sites\Grids\Grid::class => ['grid', 'Grid'],
      \Sphp\Html\Foundation\Sites\Grids\Column::class => ['grid', 'Column'],
      \Sphp\Html\Foundation\Sites\Grids\Row::class => ["grid", 'Row'],
      \Sphp\Html\Foundation\Sites\Grids\BlockGrid::class => ['block_grid', 'Block Grid'],
      OffCanvas::class => ['off-canvas', 'Off-canvas'],
  ];

  /**
   * Constructs a new instance
   * 
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   */
  public function __construct($defaultTarget = '_blank') {
    parent::__construct(new UrlGenerator('http://foundation.zurb.com/sites/docs/', $defaultTarget));
  }

  /**
   * Returns a hyperlink object pointing to a Foundation docs component page
   * 
   * @param  string|\object $className PHP class name or PHP object
   * @param  string|null $linkText optional text of the hyperlink
   * @param  null|string $title optional title of the hyperlink
   * @return Hyperlink hyperlink object pointing to a Foundation docs component page
   */
  public function getComponentLink($className, $linkText = null, $title = null) {
    if (array_key_exists($className, self::$componentMap)) {
      $page = self::$componentMap[$className][0];
      if (Strings::isEmpty($linkText)) {
        $linkText = self::$componentMap[$className][1];
      }
      if (Strings::isEmpty($title)) {
        $title = "Foundation " . self::$componentMap[$className][1] . ' component';
      }
      return $this->hyperlink("$page.html", $linkText, $title);
    } else {
      return $this->hyperlink("", $linkText);
    }
  }

  /**
   * Returns a hyperlink object pointing to a Foundation docs component page
   * 
   * @param  string|\object $className PHP class name or PHP object
   * @param  string|null $linkText optional text of the hyperlink
   * @param  null|string $title optional title of the hyperlink
   * @return Hyperlink hyperlink object pointing to a Foundation docs component page
   */
  public function docsLink($className, $linkText = null, $title = null) {
    if (array_key_exists($className, self::$componentMap)) {
      $page = self::$componentMap[$className][0];
      if (Strings::isEmpty($linkText)) {
        $linkText = self::$componentMap[$className][1];
      }
      if (Strings::isEmpty($title)) {
        $title = 'Foundation ' . self::$componentMap[$className][1] . ' component';
      }
      return $this->hyperlink("components/$page.html", $linkText, $title);
    } else {
      return $this->hyperlink("components/$className.html", $linkText);
    }
  }

  /**
   * Returns a hyperlink object pointing to a Foundation docs component page
   * 
   * @param  string|null $linkText optional text of the hyperlink
   * @param  string|null $fragment PHP class name or PHP object
   * @param  null|string $title optional title of the hyperlink
   * @return Hyperlink hyperlink object pointing to a Foundation docs component page
   */
  public function gridLink($linkText = null, $fragment = null, $title = null) {
    if ($fragment !== null) {
      $fragment = "#$fragment";
    }
    if (Strings::isEmpty($linkText)) {
      $linkText = 'The Grid';
    }
    if (Strings::isEmpty($title)) {
      $title = 'Foundation docs: The Grid';
    }
    return $this->hyperlink("grid.html$fragment", $linkText);
  }

  /**
   * 
   * @return self new instance of linker
   */
  public static function get() {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
