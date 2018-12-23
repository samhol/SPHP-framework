<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Forms;

/**
 * Implements a Freefind search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FreefindSearchForm extends AbstractSearchForm {

  /**
   * Constructor
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
