<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\Forms\Inputs\ValidableInput;
use Sphp\Html\TraversableContent;

/**
 * Defines properties for a select menu in HTML forms
 *
 * The &lt;select&gt; element is used to create a drop-down list. The
 * &lt;option&gt; tags inside the &lt;select&gt; element define the available
 * options in the list.
 *
 * **Notes:**
 *
 * * Nesting {@link Optgroup} in a {@link self} menu: nested menus are currently 
 *   not supported in most web browsers. However future versions of HTML may extend the 
 *   grouping mechanism to allow for nested groups (i.e., {@link Optgroup} components may 
 *   nest). This will allow authors to represent a richer hierarchy of choices.
 * * Because of the above nesting of {@link Optgroup} objects is supported
 *   but not recomended.
 * * The {@link Select} component is a form control and can be used in a 
 *   form to collect user input.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_select.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface SelectMenuInterface extends ValidableInput, TraversableContent {

  /**
   * Returns all &lt;option&gt; components
   * 
   * @return TraversableContent containing &lt;option&gt; components
   */
  public function getOptions(): TraversableContent;

  /**
   * Returns all the selected &lt;option&gt; components
   * 
   * @return TraversableContent containing selected &lt;option&gt; components
   */
  public function getSelectedOptions(): TraversableContent;

  /**
   * Sets the selected options of the menu object
   *
   * @param  scalar|scalar[] $selectedValues selected options of the menu object
   * @return $this for a fluent interface
   */
  public function setSelectedValues($selectedValues);

  /**
   * Specifies that multiple options can or cannot be selected at once
   * 
   * @param  boolean $multiple true if multiple selections are allowed, 
   *         otherwise false
   * @return $this for a fluent interface
   */
  public function selectMultiple(bool $multiple = true);

  /**
   * Sets the number of the visible &lt;option&gt; components
   * 
   * **Note:** In Chrome and Safari, this attribute may not work as 
   *  expected for size="2" and size="3".
   * 
   * @param  int $size optional number of visible &lt;option&gt; components
   * @return $this for a fluent interface
   */
  public function setSize(int $size = null);
}
