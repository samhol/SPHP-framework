<?php

/**
 * PreviousPage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

/**
 * Class Models a previous page button for Foundation Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PreviousPage extends AbsractArrowPage {

	/**
	 * {@inheritdoc}
	 */
	public function __construct(Page $target = null, $content = "&laquo;") {
		parent::__construct("&laquo;", $target);
	}

}
