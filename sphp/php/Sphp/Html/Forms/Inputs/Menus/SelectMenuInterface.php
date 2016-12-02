<?php

/**
 * SelectMenuInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\Forms\Inputs\ValidableInputInterface;
use Sphp\Html\TraversableInterface;
use Sphp\Html\ContainerInterface;

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
 * @since   2011-03-10
 * @link    http://www.w3schools.com/tags/tag_select.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SelectMenuInterface extends ValidableInputInterface, TraversableInterface {

  /**
   * Returns all {@link Option} components in the component
   * 
   * @return ContainerInterface containing {@link Option} components
   */
  public function getOptions();

  /**
   * Returns all the selected {@link Option} components in the component
   * 
   * @return ContainerInterface containing selected {@link Option} components
   */
  public function getSelectedOptions();

  /**
   * Sets the selected options of the menu object
   *
   * @param  scalar|scalar[] $selectedValues selected options of the menu object
   * @return self for PHP Method Chaining
   */
  public function setSelectedValues($selectedValues);

  /**
   * Specifies that multiple options can or cannot be selected at once
   * 
   * @param  boolean $multiple true if multiple selections are allowed, 
   *         otherwise false
   * @return self for PHP Method Chaining
   */
  public function selectMultiple($multiple = true);

  /**
   * Sets the number of the visible {@link Option} components
   * 
   * **Note:** In Chrome and Safari, this attribute may not work as 
   *  expected for size="2" and size="3".
   * 
   * @param  int $size the number of the visible {@link Option} components
   * @return self for PHP Method Chaining
   */
  public function setSize($size);
}
