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
 * Implements a SiteSearch360 search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SiteSearch360FormBuilder extends AbstractSearchFormBuilder {

  /**
   * Constructor
   * 
   * @param string $siteId
   * @param string $initialValue
   */
  public function __construct(string $siteId, string $initialValue = null) {
    parent::__construct();
    $this->siteId = $siteId;
    $this->getSearchField()->setName('ss360Query')->setInitialValue($initialValue);
    $this->getSearchField()->addCssClass('sphp-search-searchBox', 'sphp-ss360-searchBox');
  }

  public function createEmptyForm(): \Sphp\Html\Forms\ContainerForm {
    $form = new \Sphp\Html\Forms\ContainerForm();
    $form->addCssClass('sphp', 'search-form');
    $form->attributes()->protect('data-sphp-ss360-siteid', $this->siteId);
    return $form;
  }

}
