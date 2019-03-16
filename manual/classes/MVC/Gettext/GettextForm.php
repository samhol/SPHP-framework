<?php

namespace Sphp\Manual\MVC\Gettext;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Foundation\Sites\Forms\Inputs\BasicInputCell;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Foundation\Sites\Forms\Inputs\Radioboxes;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;

class GettextForm {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Input
   */
  private $fieldTypeSelector;

  /**
   * @var Input
   */
  private $msgTypeSelector;

  /**
   * @var Input
   */
  private $queryField;

  public function __construct() {
    $this->buildMessageTypeSelector();
    $this->buildFieldTypeSelector();
    $this->buildQueryField();
  }

  public function setInitialValues(string $msgType = null, string $part = null, string $query = null) {
    
  }

  public function setQueryFieldValue(string $value = null) {
    $this->queryField->setSubmitValue($value);
    return $this;
  }

  public function setSelectedMessageType(string $value = null) {
    $this->msgTypeSelector->setSubmitValue($value);
    return $this;
  }

  public function setSelectedFieldType(string $value = null) {
    $this->fieldTypeSelector->setSubmitValue($value);
    return $this;
  }

  public function buildMessageTypeSelector() {
    $this->msgTypeSelector = new Select('msg_type');
    $this->msgTypeSelector->addCssClass('input-group-field');
    $this->msgTypeSelector->appendOption('singular', 'Singular form of');
    $this->msgTypeSelector->appendOption('plural', 'Plural form of');
    $this->msgTypeSelector->appendOption('singular+plural', 'Singular or Plural form of');

    $this->msgTypeSelector->setSubmitValue('singular+plural');
  }

  public function buildFieldTypeSelector() {
    $this->fieldTypeSelector = new Select('type');
    $this->fieldTypeSelector->addCssClass('input-group-field');
    $this->fieldTypeSelector->appendOption('id', 'ID');
    $this->fieldTypeSelector->appendOption('translation', 'Translation');
    $this->fieldTypeSelector->appendOption('original+translation', 'ID or Translation');
    $this->fieldTypeSelector->setSubmitValue('original+translation');
  }

  public function buildQueryField() {
    $this->queryField = new TextInput('query');
  }

  public function generate(): GridForm {
    $form = new GridForm('/gettext/', 'get');
    $form->addCssClass('sphp', 'gettext-form');
    $row1 = new FormRow();
    $row1->addCssClass();
    $inputGroup1 = new InputGroup();
    $inputGroup1->appendLabel('Search');
    $row2 = new FormRow();
    $inputGroup1->append($this->msgTypeSelector);
    $inputGroup1->append($this->fieldTypeSelector);

    $form->append($inputGroup1);
    $inputrow = new FormRow();
    $inputrow->addCssClass('foo');

    $inputGroup = new InputGroup();
    $inputGroup->appendLabel('Containing text');
    $inputGroup->append($this->queryField)->setPlaceholder('Search Gettext');
    $inputGroup->appendSubmitter('<i class="fas fa-search"></i><span class="show-for-sr">search</span>');
    //$inputrow->appendResetter('<i class="fas fa-undo"></i><span class="show-for-sr">reset form</span>')->addCssClass('alert');
    //$row2->appendCell($inputrow);
    //$row2->append($this->queryField);
    //$row2->appendCell(Button::submitter('submit'), ['small-12', 'medium-shrink']);

    $inputrow->appendCell($inputGroup)->auto();
    $form->append($inputrow);
    return $form;
  }

  public function getHtml(): string {
    return $this->generate()->getHtml();
  }

}
