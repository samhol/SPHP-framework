<?php

/**
 * SearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\SubmitterInterface;
use Sphp\Html\Forms\Buttons\Submitter;
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

  public function __construct($action = null, $method = 'get') {
    parent::__construct('form');
    $this->setAction($action)
            ->setMethod($method)
            ->setTarget('_self');
    $this->setSubmitButton(new Submitter(Icon::fontAwesome('fa-search')));
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

  public function getSubmitButton(): SubmitterInterface {
    return $this->submitButton;
  }

  /**
   * 
   * @param  Submitter $submitButton
   * @return $this
   */
  public function setSubmitButton(SubmitterInterface $submitButton) {
    $this->submitButton = $submitButton;
    $this->submitButton->cssClasses()->lock('button');
    return $this;
  }

  public function showLabel($additionalControls = true) {
    $this->showLabel = $additionalControls;
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
  <div class="input-group">';
    if ($this->showLabel) {
      $output .= '<span class="input-group-label">Search for:</span>';
    }
    $output .= $this->searchField->getHtml();
    $output .= '<div class="input-group-button">
      ' . $this->submitButton->getHtml() . '
    </div>
  </div>';
    return $output;
  }

  public function getData() {
    
  }

  public function setData(array $data = array(), $filter = true) {
    
  }

}
