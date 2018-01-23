<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Forms;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
use Sphp\Html\Forms\Inputs\SearchInput;
use Sphp\Html\Forms\Buttons\SubmitterInterface;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Icons\Icons;
use Sphp\Html\AbstractComponent;

/**
 * Implements a Sami PHP API search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SiteSearch360Form extends AbstractSearchForm {

  use \Sphp\Html\ContentTrait;

  private static $instance;

  /**
   * Constructs a new instance
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
