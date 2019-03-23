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
use Sphp\Html\Forms\ContainerForm;

/**
 * Implements a Sami PHP API search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SamiApiSearchFormBuilder extends AbstractSearchFormBuilder {

  /**
   * @var string
   */
  private $apiRoot;

  /**
   * Constructor
   * 
   * @param string $apiRoot
   */
  public function __construct(string $apiRoot) {
    if (!Strings::endsWith($apiRoot, '/search.html')) {
      $apiRoot = Strings::trimRight($apiRoot, '/') . '/search.html';
    }
    $this->apiRoot = $apiRoot;
    parent::__construct();
    $this->getSearchField()->setName('search');
  }

  public function createEmptyForm(): ContainerForm {
    $form = new ContainerForm($this->apiRoot, 'get');
    $form->addCssClass('sphp', 'search-form');
    return $form;
  }

}
