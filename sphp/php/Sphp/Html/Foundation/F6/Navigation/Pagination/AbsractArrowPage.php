<?php

/**
 * AbsractArrowPage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

/**
 * Class Models an abstract jumping button for Foundation Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbsractArrowPage extends Page {

	/**
	 * Constructs a new instance
	 *
	 * @param mixed $content the visual content of the component
	 * @param Page $target optional component from which the link properties are created
	 */
	public function __construct($content, Page $target = null) {
		parent::__construct($content, null, null);
		$this->setPage($target);
	}
	
	/**
	 * 
	 * @param  Page $target optional component from which the link properties are created
	 * @return self for PHP Method Chaining
	 */
	public function setPage(Page $target = null) {
		if ($target === null) {
			$this->removeAttr("href")
					->setTarget(false)
					->available(false);
		} else {
			$this->setHref($target->getHref())
					->setTarget($target->getTarget())
					->available(true);
		}
		return $this;
	}

}
