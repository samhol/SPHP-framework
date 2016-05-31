<?php

/**
 * DateStamp.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Span as Span;

/**
 * Class models a HTML based stamp-element that describes a {@link Datetime} object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @version 2.0.1
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DateStamp extends AbstractComponent {

	/**
	 * Constructs a new instance
	 *
	 * @param  \DateTime $datetime date and time
	 */
	public function __construct(\DateTime $datetime) {
		parent::__construct("div");
		$this->cssClasses()->lock("dateStamp");
		$this->setDatetime($datetime);
	}

	/**
	 * Sets the datetime for the element
	 *
	 * @param  \DateTime $datetime
	 * @return self for PHP Method Chaining
	 */
	public function setDatetime(\DateTime $datetime) {
		$this->content()["year"] = new Span($datetime->format("Y"), "year");
		$this->content()["month"] = new Span($datetime->format("M"), "month");
		$this->content()["day"] = new Span($datetime->format("d"), "day");
		return $this;
	}

}
