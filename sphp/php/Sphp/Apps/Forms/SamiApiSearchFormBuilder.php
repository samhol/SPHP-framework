<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Forms;

use Sphp\Stdlib\Strings;
use Sphp\Html\Forms\Form;

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
    if (!str_ends_with($apiRoot, '/search.html')) {
      $apiRoot = Strings::trimRight($apiRoot, '/') . '/search.html';
    }
    $this->apiRoot = $apiRoot;
    parent::__construct();
    $this->getSearchField()->setName('search');
  }

  public function createEmptyForm(): Form {
    $form = new Form($this->apiRoot, 'get');
    $form->addCssClass('sphp', 'search-form');
    return $form;
  }

}
