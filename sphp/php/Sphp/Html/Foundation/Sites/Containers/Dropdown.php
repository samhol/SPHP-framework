<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\AbstractContent;
use Sphp\Html\Content;
use Sphp\Html\Component;
use Sphp\Html\Span;
use Sphp\Html\Div;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Implements Dropdown HTML component
 *
 * This component can be used to attach dropdowns or pop overs to
 * whatever Component needed.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/dropdown.html Foundation Dropdown
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dropdown extends AbstractContent implements Component {

  use \Sphp\Html\ComponentTrait;

  private static $sizes = [
      'tiny', 'small', 'large', 'xlarge', 'xxlarge'
  ];

  /**
   * @var Component
   */
  private $trigger;

  /**
   * @var Component
   */
  private $dropdown;

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  /**
   * Constructor
   *
   * @param  Content|mixed $trigger the target component for the dropdown functionality
   * @param  mixed $dropdown the dropdown or the content of the dropdown
   */
  public function __construct($trigger, $dropdown) {
    if (!$dropdown instanceof Component) {
      $dropdown = new Div($dropdown);
    }
    $this->dropdown = $dropdown;
    $this->dropdown->attributes()->setInstance($this->options = new PropertyCollectionAttribute('data-options'));
    $this->dropdown->identify();
    $this->dropdown->cssClasses()->protectValue('dropdown-pane');
    $this->dropdown->attributes()->demand('data-dropdown');
    $this->setTrigger($trigger);
  }

  public function __clone() {
    parent::__clone();
    $this->identify('Dropdown');
    $this->trigger = clone $this->trigger;
    $this->setTrigger($this->trigger);
  }

  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $correctName = lcfirst(str_replace('-', '', ucwords(str_replace('data-', '', $name), '-')));
    $this->options->setProperty($correctName, $value);
    return $this;
  }

  public function getDropdown() {
    return $this->dropdown;
  }

  public function setDropdown(Component $dropdown) {
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
    $this->trigger->cssClasses()->remove('float-left', 'float-right');
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
    if (!($trigger instanceof Component)) {
      $trigger = new Span($trigger);
    }
    $this->trigger = $trigger
            ->setAttribute('data-toggle', $this->dropdown->identify());
    return $this;
  }

  /**
   * Returns the trigger component controlling this dropdown
   *
   * @return Component the trigger component controlling this dropdown
   */
  public function getTrigger(): Component {
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
    $this->setOption('data-close-on-click', $flag);
    return $this;
  }

  /**
   * 
   * @param  boolean $flag
   * @return $this for a fluent interface
   */
  public function autoFocus(bool $flag = true) {
    $this->setOption('data-auto-focus', $flag);
    return $this;
  }

  public function attributes(): \Sphp\Html\Attributes\HtmlAttributeManager {
    return $this->trigger->attributes();
  }

}
