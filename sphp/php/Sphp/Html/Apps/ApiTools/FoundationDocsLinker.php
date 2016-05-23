<?php

/**
 * FoundationDocsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\Hyperlink as Hyperlink,
    Sphp\Util\Strings as Strings;

/**
 * Link generator for Foundation Docs related hyperlinks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FoundationDocsLinker extends AbstractLinker {

  /**
   * component map
   *
   * @var string[][] 
   */
  private static $componentMap = [
      \Sphp\Html\Foundation\Navigation\SubNav\SubNav::class => ["subnav", "Sub Nav"],
      \Sphp\Html\Foundation\Navigation\TopBar\TopBar::class => ["topbar", "Top Bar"],
      \Sphp\Html\Foundation\Structure\Grid::class => ["grid", "Grid"],
      \Sphp\Html\Foundation\Structure\Column::class => ["grid", "Grid"],
      \Sphp\Html\Foundation\Structure\Row::class => ["grid", "Grid"],
      \Sphp\Html\Foundation\Structure\BlockGrid::class => ["block_grid", "Block Grid"],
  ];

  /**
   * Constructs a new instance
   * 
   * @param scalar[] $attrs the default value of the attributes used in the 
   *        generated links
   */
  public function __construct($attrs = ["target" => "foundation.docs", "class" => "external foundation-docs-link api"]) {
    parent::__construct("http://foundation.zurb.com/docs/", $attrs);
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
        $title = "Foundation " . self::$componentMap[$className][1] . " component";
      }
      return $this->getHyperlink("components/$page.html", $linkText, $title);
    } else {
      return $this->getHyperlink("components/$className.html", $linkText);
    }
  }

}
