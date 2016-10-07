<?php

/**
 * Optgroup.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use Sphp\Html\TraversableTrait;

/**
 * Class Models an HTML &lt;optgroup&gt; tag

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
 * recomended.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-06-10
 * @link http://www.w3schools.com/tags/tag_optgroup.asp w3schools HTML API link
 * @filesource
 */
class Optgroup extends AbstractContainerComponent implements SelectMenuContentInterface, TraversableInterface {

  use OptionHandlingTrait,
      TraversableTrait;

  /**
   * Constructs a new instance of the {@link Optgroup} component
   *
   * **Recognized mixed $opt types:**
   * 
   * 1. a  {@link SelectMenuContentInterface} $opt is stored as such
   * 2. a string $opt corresponds to a new {@link Option}($opt, $opt) object
   * 3. a string[] $opt with $key => $val pairs corresponds to an array of 
   *   new {@link Option}($key, $val) objects
   * 4. all other types of $opt are converted to strings and and stored as 
   *   in section 2.
   * 
   * @param string $label specifies a label for an option-group
   * @param mixed|mixed[] $opt the content
   */
  public function __construct($label = '', $opt = null) {
    parent::__construct('optgroup');
    $this->setLabel($label);
    if ($opt !== null) {
      $this->append($opt);
    }
  }

  /**
   * Returns the value of thelabel attribute
   *
   * @return string the value of thelabel attribute
   * @link   http://www.w3schools.com/tags/att_optgroup_label.asp label attribute
   */
  public function getLabel() {
    return $this->getAttr('label');
  }

  /**
   * Sets the value of thelabel attribute
   *
   * @param  string $label the value of thelabel attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_optgroup_label.asp label attribute
   */
  public function setLabel($label) {
    return $this->setAttr('label', $label);
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return InputInterface for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
   */
  public function disable($disabled = true) {
    $this->attrs()->set('disabled', (bool) $disabled);
    return $this;
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
   */
  public function isEnabled() {
    return !$this->attrs()->exists('disabled');
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->content()->count();
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

}
