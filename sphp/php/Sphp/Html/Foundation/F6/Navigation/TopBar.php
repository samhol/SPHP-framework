<?php

/**
 * TopBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\Div as Div;
use Sphp\Core\Types\Arrays as Arrays;
use Sphp\Html\Foundation\F6\Navigation\MenuInterface as MenuInterface;
use Sphp\Html\Foundation\F6\Navigation\DropdownMenu as DropdownMenu;
use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;
use Sphp\Html\Foundation\F6\Core\AbstractFoundationComponent as AbstractFoundationComponent;

/**
 * Class implements a Foundation Top Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopBar extends AbstractFoundationComponent {

  /**
   * The topbar Foundation options
   *
   * @var mixed[]
   */
  private $dataOptions = [];

  /**
   * Constructs a new instance
   *
   * @param mixed $title the title of the Top Bar component
   */
  public function __construct($title = null, MenuInterface $left = null, MenuInterface $right = null) {
    parent::__construct("div");
    $this->buildComponents($title, $left, $right);
    $this->cssClasses()->lock("top-bar");
  }

  /**
   * Builds the navigation components
   *
   * @param  mixed $title the title of the Top Bar component
   * @param  null|MenuInterface $leftContent
   * @param  null|MenuInterface $rightContent
   * @return self for PHP Method Chaining
   */
  private function buildComponents($title, MenuInterface $leftContent = null, MenuInterface $rightContent = null) {
    $titleArea = new Div($title);
    $titleArea->attrs()->classes()->lock("top-bar-title");
    $this->content()->set("title", $titleArea);
    // $this->attrs()->mapAttributeObject("data-objects", new MultiValueAttribute("data-objects"));
    if ($leftContent === null) {
      $leftContent = new DropdownMenu();
    }
    if ($rightContent === null) {
      $rightContent = new DropdownMenu();
    }
    $leftArea = new Div();
    $leftArea->cssClasses()->lock("top-bar-left");
    $rightArea = new Div();
    $rightArea->cssClasses()->lock("top-bar-right");
    $this->content()->set("left", $leftArea);
    $this->content()->set("right", $rightArea);
    $this->left($leftContent);
    $this->right($rightContent);
    return $this;
  }

  /**
   * Builds the data options and sets them to the attribute
   * 
   * @return self for PHP Method Chaining
   */
  private function buildDataOptions() {
    $dataOpts = Arrays::implodeWithKeys($this->dataOptions, ";", ": ");
    return $this->getNav()->setAttr("data-options", $dataOpts);
  }

  /**
   * Sets/Unsets the top bar to have a fixed position when scrolling
   * 
   * @param  boolean $fixed true if the top bar has a fixed position when scrolling, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setFixed($fixed = true) {
    if ($fixed) {
      $this->addCssClass("fixed");
    } else {
      $this->removeCssClass("fixed");
    }
    return $this;
  }

  /**
   * Sets/Unsets the top bar navigation on grid width
   * 
   * @param  boolean $use true if the top bar navigation is on grid width, otherwise false
   * @return self for PHP Method Chaining
   */
  public function useGridWidth($use = true) {
    if ($use) {
      $this->addCssClass("contain-to-grid");
    } else {
      $this->removeCssClass("contain-to-grid");
    }
    return $this;
  }

  /**
   * Sets/Unsets the top bar clickable
   * 
   * @param  boolean $clickable true if the top bar is clickable, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setClickable($clickable = true) {
    if ($clickable) {
      $this->dataOptions["is_hover"] = "false";
      $this->dataOptions["sticky_on"] = "large";
    } else if (array_key_exists("is_hover", $this->dataOptions)) {
      unset($this->dataOptions["is_hover"]);
    }
    return $this->buildDataOptions();
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title of the Navigator component
   * @return Div the title area component
   */
  public function barTitle($title = null) {
    if ($title !== null) {
      $this->content()["title"]->replaceContent($title);
    }
    return $this->content()["title"];
  }

  /**
   * Sets and Returns the left side menu area component
   *
   * @param  null|MenuInterface $menu
   * @return MenuInterface the left side menu area component
   */
  public function left(MenuInterface $menu = null) {
    if ($menu !== null) {
      $this->content()["left"]["menu"] = $menu;
    }
    return $this->content()["left"]["menu"];
  }

  /**
   * Sets and Returns the right side menu area component
   *
   * @param  null|MenuInterface $menu
   * @return MenuInterface the right side menu area component
   */
  public function right(MenuInterface $menu = null) {
    if ($menu !== null) {
      $this->content()["right"]["menu"] = $menu;
    }
    return $this->content()["right"]["menu"];
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->dataOptions = Arrays::copy($this->dataOptions);
    parent::__clone();
  }

}
