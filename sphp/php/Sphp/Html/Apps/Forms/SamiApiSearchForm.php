<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Forms;

use Sphp\Stdlib\Strings;

/**
 * Implements a Sami PHP API search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SamiApiSearchForm extends AbstractSearchForm {

  /**
   * Constructs a new instance
   * 
   * @param string $apiRoot
   */
  public function __construct(string $apiRoot) {
    if (!Strings::endsWith($apiRoot, '/search.html')) {
      $apiRoot = Strings::trimRight($apiRoot, '/') . '/search.html';
    }
    parent::__construct($apiRoot, 'get');
    $this->addCssClass('sami-search-form');
    $this->getSearchField()->setName('search');
  }

}
