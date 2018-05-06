<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Forms;

use Sphp\Stdlib\Strings;

/**
 * Implements a Sami PHP API search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
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
