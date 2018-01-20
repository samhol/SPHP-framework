<?php

/**
 * Optgroup.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs\Menus;

/**
 * Implements an HTML &lt;optgroup&gt; tag

 * **Notes:**
 *
 * **Nesting optgroups in a select menu:** The HTML spec here is broken. It
 * should allow nested optgroups and recommend user agents render them as
 * nested menus. Instead, only one optgroup level is allowed. However
 * Implementors are advised that future versions of HTML may extend the grouping
 *  mechanism to allow for nested groups (i.e., OPTGROUP elements may nest).
 * This will allow authors to represent a richer hierarchy of choices.
 *
 * Because of the above nesting of optgroup elements is supported but not
 * recommended.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_optgroup.asp w3schools HTML API
 * @filesource
 */
class Optgroup extends AbstractOptionsContainer implements MenuComponent {

  /**
   * Constructs a new instance
   *
   * **`$opt` types:**
   * 
   * 1. a {@link SelectMenuContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option Option($key, $val)} objects
   * 
   * @param string $label specifies a label for an option-group
   * @param MenuComponent|mixed[] $opt the content
   */
  public function __construct(string $label = null, $opt = null) {
    parent::__construct('optgroup', $opt);
    if ($label !== null) {
      $this->setLabel($label);
    }
  }

  /**
   * Sets the label for the group
   *
   * @param  string $label the label for the group
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_optgroup_label.asp label attribute
   */
  public function setLabel(string $label) {
    $this->attributes()->set('label', $label);
    return $this;
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->set('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->exists('disabled');
  }

}
