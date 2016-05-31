<?php

/**
 * Optgroup.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Menus;

use Sphp\Html\ContainerTag as ContainerTag;

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
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-06-10
 * @link http://www.w3schools.com/tags/tag_optgroup.asp w3schools HTML API link
 * @filesource
 */
class Optgroup extends ContainerTag implements SelectMenuContentInterface {
	
	use OptionHandlingTrait;
	
	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "optgroup";

	/**
	 * Constructs a new instance of the {@link Optgroup} component
	 *
	 * **Recognized mixed $opt types:**
	 * <ol>
	 *   * a  {@link SelectMenuContentInterface} $opt is stored as such
	 *   * a string $opt corresponds to a new {@link Option}($opt, $opt) 
	 *   object
	 *   * a string[] $opt with $key => $val pairs corresponds to an array of 
	 *   new {@link Option}($key, $val) objects
	 *   * all other types of $opt are converted to strings and and stored as 
	 *   in section 2.
	 * </ol>
	 * 
	 * @param string $label specifies a label for an option-group
	 * @param mixed|mixed[] $opt the content
	 */
	public function __construct($label = "", $opt = null) {
		parent::__construct(self::TAG_NAME);
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
		return $this->getAttr("label");
	}

	/**
	 * Sets the value of thelabel attribute
	 *
	 * @param  string $label the value of thelabel attribute
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_optgroup_label.asp label attribute
	 */
	public function setLabel($label) {
		return $this->setAttr("label", $label);
	}

	/**
	 * Activates the &lt;optgro&gt; tag object
	 *
	 * Activation is fullfilled by removing component's disabled attribute.
	 *
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
	 */
	public function enable() {
		return $this->removeAttr("disabled");
	}

	/**
	 * Deactivates the &lt;optgroup&gt; tag object
	 *
	 * Deactivation is fullfilled by setting component's disabled attribute.
	 *
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_optgroup_disabled.asp disabled attribute
	 */
	public function disable() {
		return $this->setAttr("disabled", "disabled");
	}

}
