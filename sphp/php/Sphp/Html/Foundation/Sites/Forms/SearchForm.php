<?php

/**
 * SearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Icons\Icon;

/**
 * Description of SearchForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SearchForm extends \Sphp\Html\AbstractComponent implements FormInterface {

  use \Sphp\Html\Forms\FormTrait;

  /**
   * @var TextInput
   */
  private $searchField;

  /**
   * @var Submitter
   */
  private $submitButton;

  /**
   * @var HiddenInputs
   */
  private $hiddenData;

  public function __construct() {
    parent::__construct('form');
    $this->setAction('http://search.freefind.com/find.html')
            ->setEnctype('utf-8')
            ->setMethod('get')
            ->setTarget('_self')
            ->identify('freefind');
    $this->setSubmitButton(new SubmitButton(Icon::fontAwesome('fa-search')));
    $this->hiddenData = new HiddenInputs();
    $this->setSearchField(new TextInput());
  }

  public function getSearchField(): TextInput {
    return $this->searchField;
  }

  public function setSearchField(TextInput $searchField) {
    $this->searchField = $searchField;
    $this->searchField->cssClasses()->lock('input-group-field');
    return $this;
  }

  public function getSubmitButton(): Submitter {
    return $this->submitButton;
  }

  /**
   * 
   * @param Submitter $submitButton
   * @return $this
   */
  public function setSubmitButton(Submitter $submitButton) {
    $this->submitButton = $submitButton;
    $this->submitButton->cssClasses()->lock('button');
    return $this;
  }

  public function getHiddenData(): HiddenInputs {
    return $this->hiddenData;
  }

  public function setHiddenData(array $hiddenData) {
    $this->hiddenData->setVariables($hiddenData);
    return $this;
  }

  public function contentToString(): string {
    $output = $this->hiddenData->getHtml();
    $output .= '
  <div class="input-group">
    <span class="input-group-label">Search for:</span>
    ' . $this->searchField . '
    <div class="input-group-button">
      ' . $this->submitButton->getHtml() . '
    </div>
  </div>';
    return $output;
  }

  public function getData(): \Sphp\Html\Forms\ArrayWrapper {
    
  }

  public function setData(array $data = array(), $filter = true): \Sphp\Html\Forms\FormInterface {
    
  }

}
