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

use Sphp\Html\Forms\Form;

/**
 * Implements a Freefind search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FreefindSearchFormBuilder extends AbstractSearchFormBuilder {

  /**
   * Constructor
   * 
   * @param array $data
   */
  public function __construct(array $data = []) {
    parent::__construct();
    $this->getSearchField()->setName('query');
    $this->setHiddenData($data);
  }

  public function createEmptyForm(): Form {
    $form = new Form('http://search.freefind.com/find.html', 'get');
    $form->addCssClass('sphp', 'search-form');
    return $form;
  }

}
