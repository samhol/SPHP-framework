<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Forms;

/**
 * Implements a Freefind search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FreefindSearchForm extends AbstractSearchForm {

  /**
   * Constructs a new instance
   * 
   * @param array $data
   */
  public function __construct(array $data = []) {
    parent::__construct('http://search.freefind.com/find.html', 'get');
    $this->setTarget('_self');
    $this->addCssClass('freefind-form');
    $this->getSearchField()->setName('query');
    $this->setHiddenData($data);
  }

}
