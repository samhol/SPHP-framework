<?php

/**
 * Dropdown.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\ContentInterface as ContentInterface;
use Sphp\Html\Forms\Buttons\Button as Button;

/**
 * Class implements Foundation Dropdown HTML component
 *
 * {@link self} component can be used to attach dropdowns or popovers to
 * whatever Component needed.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-10
 * @version 1.0.3
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/dropdown.html Foundation Dropdown
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dropdown extends ContainerTag implements \Sphp\Html\AjaxLoaderInterface {

  use \Sphp\Html\Foundation\F6\Core\SizingTrait,
      \Sphp\Html\AjaxLoaderTrait;

  /**
   * the target component for the dropdown functionality
   *
   * @var Button
   */
  private $target;

  /**
   * Constructs a new instance
   *
   * @param  ContentInterface|mixed $togleButton the target component for the dropdown functionality
   * @param  mixed $content the content of the dropdown
   */
  public function __construct($togleButton, $content = null) {
    parent::__construct("div", $content);
    $this->identify("Dropdown")
            ->lockCssClass("dropdown-pane")
            ->setAttrRequired("data-dropdown")
            ->setTarget($togleButton);
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    parent::__clone();
    $this->identify("Dropdown");
    $this->target = clone $this->target;
    $this->setTarget($this->target);
  }

  /**
   * Positions dropdown on the top, bottom, left, or right of the target element.
   *
   * **Available alignment options:**
   * 
   * * `'top'`: Positions the dropdown on the top of the controller element
   * * `'left'`: Positions the dropdown on the left of the controller element
   * * `'bottom'`: Positions the dropdown on the bottom of the controller element
   * * `'right'`: Positions the dropdown on the right of the controller element
   * * `false`: Removes settings
   *
   * @param  string|boolean $alignment the alignment value
   * @return self for PHP Method Chaining
   */
  public function align($alignment) {
    $this->removeCssClass("top left bottom right");
    if ($alignment !== false) {
      $this->addCssClass($alignment);
    }
    return $this;
  }

  /**
   * Changes the direction of the dropdown
   * 
   * **Available floating options:**
   * 
   * * `'left'`: Floats the dropdown on the left of the controller element
   * * `'right'`: Floats the dropdown on the right of the controller element
   * * `false`: Removes floating settings
   *
   * @param  string|boolean $float the floating value
   * @return self for PHP Method Chaining
   */
  public function float($float = false) {
    $this->target->removeCssClass("float-left float-right");
    if ($float !== false) {
      $this->target->addCssClass("float-$float");
    }
    return $this;
  }

  /**
   * Sets the component having this dropdown
   *
   * @param  mixed the component having this dropdown
   * @return self for PHP Method Chaining
   */
  public function setTarget($togleButton) {
    if (!($togleButton instanceof Button)) {
      $togleButton = new Button("button", $togleButton);
    }
    $this->target = $togleButton
            ->setAttr("data-toggle", $this->getId());
    return $this;
  }

  /**
   * Returns the button component having this dropdown
   *
   * @return Button the button component having this dropdown
   */
  public function getTarget() {
    return $this->target;
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->target . parent::getHtml();
  }

  /**
   * 
   * @param  boolean $flag
   * @return self for PHP Method Chaining
   */
  public function closeOnBodyClick($flag = true) {
    if ($flag) {
      $this->attrs()->set("data-close-on-click", "true");
    } else {
      $this->attrs()->set("data-close-on-click", "false");
    }
    return $this;
  }

  /**
   * 
   * @param  boolean $flag
   * @return self for PHP Method Chaining
   */
  public function autoFocus($flag = true) {
    if ($flag) {
      $this->attrs()->set("data-auto-focus", "true");
    } else {
      $this->attrs()->set("data-auto-focus", "false");
    }
    return $this;
  }

}
