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
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SiteSearch360Form extends AbstractSearchForm {

  use \Sphp\Html\ContentTrait;

  private static $instance;

  /**
   * Constructor
   * 
   * @param string|null $initialValue
   */
  public function __construct(string $siteId, string $initialValue = null) {
    parent::__construct(null, 'get');
    $this->getSearchField()->setName('ss360Query')->setSubmitValue($initialValue);
    $this->getSearchField()->addCssClass('sphp-search-searchBox', 'sphp-ss360-searchBox');
    $this->attributes()->protect('data-sphp-ss360-siteid', $siteId);
  }

  public function createResultComponent(): \Sphp\Html\Div {
    $output = new \Sphp\Html\Div();
    $output->cssClasses()->protect('sphp-ss360-searchResults');
    return $output;
  }

  public static function create(string $siteId, string $initialValue = null): SiteSearch360Form {
    if (self::$instance === null) {
      self::$instance = new static($siteId, $initialValue);
    }
    return self::$instance;
  }

}
