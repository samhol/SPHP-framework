<?php

/**
 * LabelableInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms;

/**
 * Interface defines features for all labelable components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LabelableInterface {

	/**
	 * Attach a {@link Label} label to the  component
	 *
	 * @param  mixed|label $label the input label ({@link Label}) or its content
	 * @return self for PHP Method Chaining
	 */
	public function setLabel($label);

	/**
	 * Checks whether the {@link Label} is attached to the component or not
	 *
	 * @return boolean true if the label is defined, otherwise false
	 * @link   Label
	 */
	public function hasLabel();

	/**
	 * Returns the {@link Label} component attached to the component
	 *
	 * @return Label|null created label component
	 */
	public function getLabel();
}
