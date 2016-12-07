<?php

/**
 * EventInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Events;

/**
 * Defines an event
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface EventInterface {

	/**
	 * Return the name of the event
	 *
	 * @return string the name of the event
	 */
	public function getName();

	/**
	 * Return the subject
	 *
	 * @return mixed subject
	 */
	public function getSubject();

	/**
	 * Sets the subject
	 * 
	 * @param  mixed $subject the subject
	 * @return self for PHP Method Chaining
	 */
	public function setSubject($subject);

	/**
	 * Stops the event from being used anymore
	 *
	 * @return self for PHP Method Chaining
	 */
	public function stopPropagation();

	/**
	 * Checks if the event is stopped
	 * 
	 * @return boolean true if the event is stopped
	 */
	public function isStopped();
}
