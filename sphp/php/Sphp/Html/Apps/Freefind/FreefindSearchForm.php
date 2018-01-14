<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Freefind;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
use Sphp\Html\Forms\Inputs\SearchInput;
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

  /**
   * @var HiddenInputs
   */
  private $hiddenData;

  /**
   * @var string
   */
  private $label;

  /**
   * @var SearchInput
   */
  private $searchField;

  /**
   * @var Submitter
   */
  private $submitButton;

  public function __construct(array $data = []) {
    parent::__construct('form');
    $this->setAction('http://search.freefind.com/find.html')
            ->setMethod('get')
            ->setTarget('_self');
    $this->addCssClass('freefind-form');
    $this->setSubmitButton(new Submitter(Icons::fontAwesome('fa-search')));
    $this->hiddenData = new HiddenInputs();
    $this->searchField = new SearchInput('query');
    $this->searchField->setName('query');
    // $this->searchField->cssClasses()->protect('input-group-field');
    $this->setHiddenData($data);
  }

  protected function build(): InputGroup {
    $group = new InputGroup();
    if ($this->label) {
      $group->appendLabel($this->label);
    }
    $group->append($this->searchField);
    $group->append($this->submitButton);
    return $group;
  }

  public function contentToString(): string {
    return $this->hiddenData->getHtml() . $this->build();
  }

  /**
   * Sets the placeholder text for the search field
   *
   * @param  string $placeholder the value of the placeholder attribute
   * @return $this for a fluent interface
   */
  public function setPlaceholder(string $placeholder = null) {
    $this->searchField->setPlaceholder($placeholder);
    return $this;
  }

  public function getSearchField(): SearchInput {
    return $this->searchField;
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

  public function setLabelText(string $text = null) {
    $this->label = $text;
    return $this;
  }

  public function getHiddenData(): HiddenInputs {
    return $this->hiddenData;
  }

  public function setHiddenData(array $hiddenData) {
    $this->hiddenData->setVariables($hiddenData);
    return $this;
  }

  public function setData(array $data = []) {
    
  }

}
