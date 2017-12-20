<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Freefind;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Buttons\SubmitterInterface;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Icons\Icons;
use Sphp\Html\AbstractComponent;

/**
 * Implements a Freefind search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FreefindSearchForm extends AbstractComponent implements FormInterface {

  use \Sphp\Html\Forms\FormTrait;

  private $additionalControls = false;

  public function __construct(array $data = []) {
    parent::__construct('form');
    $this->setAction('http://search.freefind.com/find.html')
            ->setMethod('get')
            ->setTarget('_self');
    $this->setSubmitButton(new Submitter(Icons::fontAwesome('fa-search')));
    $this->hiddenData = new HiddenInputs();
    $this->setSearchField(new TextInput());
    $this->setHiddenData($data);
  }

  public function getAdditionalControls() {
    return $this->additionalControls;
  }

  public function setAdditionalControls($additionalControls) {
    $this->additionalControls = $additionalControls;
    return $this;
  }

  public function contentToString(): string {
    $output = '';
    if ($this->additionalControls) {
      $output .= '<a href="http://search.freefind.com/find.html?si=51613081&amp;m=0&amp;p=0">sitemap</a> | ';
      $output .= '<a href="http://search.freefind.com/find.html?si=51613081&amp;pid=a">advanced</a>';
    }
    $output .= $this->hiddenData->getHtml();
    $output .= '<div class="input-group">';
    if ($this->showLabel) {
      $output .= '<span class="input-group-label">Search for:</span>';
    }
    $output .= $this->searchField->getHtml();
    $output .= '<div class="input-group-button">' . $this->submitButton->getHtml() . '</div></div>';
    return $output;
  }

  public function getSearchField(): TextInput {
    return $this->searchField;
  }

  public function setSearchField(TextInput $searchField) {
    $this->searchField = $searchField;
    $this->searchField->cssClasses()->protect('input-group-field');
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
    $this->submitButton->cssClasses()->protect('button');
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

  public function getData() {
    
  }

  public function setData(array $data = array()) {
    
  }

}
