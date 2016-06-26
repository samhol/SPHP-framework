<?php

/**
 * NextPage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

/**
 * Class Models a next page button for Foundation Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NextPage extends AbsractArrowPage {

  /**
   * {@inheritdoc}
   */
  public function __construct($href = null, $target = "_self") {
    parent::__construct($href, $target);
    $this->cssClasses()->lock("pagination-next");
  }

}
