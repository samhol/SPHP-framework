<?php

/**
 * Dropdown.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Content;
use Sphp\Html\ComponentInterface;

/**
 * Implements Dropdown HTML component
 *
 * This component can be used to attach dropdowns or pop overs to
 * whatever Component needed.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/dropdown.html Foundation Dropdown
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dropdown implements Content {

  use \Sphp\Html\ContentTrait;

  private static $sizes = [
      'tiny', 'small', 'large', 'xlarge', 'xxlarge'
  ];

  /**
   * @var ComponentInterface
   */
  private $trigger;

  /**
   * @var ComponentInterface
   */
  private $dropdown;

  /**
   * Constructs a new instance
   *
   * @param  Content|mixed $trigger the target component for the dropdown functionality
   * @param  mixed $dropdown the dropdown or the content of the dropdown
   */
  public function __construct($trigger, $dropdown) {
    if (!$dropdown instanceof ComponentInterface) {
      $dropdown = new \Sphp\Html\Div($dropdown);
    }
    $this->dropdown = $dropdown;
    $this->dropdown->identify();
    $this->dropdown->cssClasses()->protect('dropdown-pane');
    $this->dropdown->attrs()->demand('data-dropdown');
    $this->setTrigger($trigger);
  }

  public function __clone() {
    parent::__clone();
    $this->identify('Dropdown');
    $this->trigger = clone $this->trigger;
    $this->setTrigger($this->trigger);
  }

  public function getDropdown() {
    return $this->dropdown;
  }

  public function setDropdown(ComponentInterface $dropdown) {
    $this->dropdown = $dropdown;
    return $this;
  }

  /**
   * Sets the size of the button 
   * 
   * Predefined values of <var>$size</var> parameter:
   * 
   * * `'tiny'` for tiny dropdown pane
   * * `'small'` for small dropdown pane
   * * `'large'` for large dropdown pane
   * * `'xlarge'` for x-large dropdown pane
   * * `'xxlarge'` for xx-large dropdown pane
   * 
   * @param  string|null $size optional CSS class name defining dropdown pane size
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSize($size) {
    $this->resetSize();
    $this->dropdown->cssClasses()->add($size);
    return $this;
  }

  /**
   * Resets the size settings of the component
   *
   * @return $this for a fluent interface
   */
  public function resetSize() {
    $this->dropdown->cssClasses()
            ->remove(static::$sizes);
    return $this;
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
   * @return $this for a fluent interface
   */
  public function align($alignment) {
    $this->dropdown->cssClasses()->remove('top left bottom right');
    if ($alignment !== false) {
      $this->dropdown->cssClasses()->add($alignment);
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
   * @return $this for a fluent interface
   */
  public function setFloat($float = false) {
    $this->trigger->cssClasses()->remove('float-left float-right');
    if ($float !== false) {
      $this->trigger->cssClasses()->add("float-$float");
    }
    return $this;
  }

  /**
   * Sets the component controlling this dropdown
   *
   * @param  mixed the component controlling this dropdown
   * @return $this for a fluent interface
   */
  public function setTrigger($trigger) {
    if (!($trigger instanceof ComponentInterface)) {
      $trigger = new \Sphp\Html\Span($trigger);
    }
    $this->trigger = $trigger
            ->setAttr('data-toggle', $this->dropdown->identify());
    return $this;
  }

  /**
   * Returns the trigger component controlling this dropdown
   *
   * @return ComponentInterface the trigger component controlling this dropdown
   */
  public function getTrigger() {
    return $this->trigger;
  }

  public function getHtml(): string {
    return $this->trigger->getHtml() . $this->dropdown->getHtml();
  }

  /**
   * 
   * @param  boolean $flag
   * @return $this for a fluent interface
   */
  public function closeOnBodyClick(bool $flag = true) {
    if ($flag) {
      $this->dropdown->attrs()->set('data-close-on-click', 'true');
    } else {
      $this->dropdown->attrs()->set('data-close-on-click', 'false');
    }
    return $this;
  }

  /**
   * 
   * @param  boolean $flag
   * @return $this for a fluent interface
   */
  public function autoFocus(bool $flag = true) {
    if ($flag) {
      $this->dropdown->attrs()->set('data-auto-focus', 'true');
    } else {
      $this->dropdown->attrs()->set('data-auto-focus', 'false');
    }
    return $this;
  }

}
