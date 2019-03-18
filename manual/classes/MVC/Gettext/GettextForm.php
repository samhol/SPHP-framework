<?php

namespace Sphp\Manual\MVC\Gettext;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
use Sphp\Html\Foundation\Sites\Forms\Inputs\SwitchBoard;
use Sphp\Html\Foundation\Sites\Containers\Dropdown;
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

  public function buildOptionSelector() {
    $sb = new SwitchBoard;
    $sb->appendNewSwitch('Singular', 's', 'foo');
    $sb->appendNewSwitch('Plural', 'p', 'foobar');
    $sb->appendNewSwitch('Messages', 'msg', null);
    $sb->appendNewSwitch('Message IDs', 'id', null);
    $sb->setDescription('Select used fields');
    $dd = new Dropdown('Options', $sb);
    $dd->closeOnBodyClick(true);
    $dd->setOption('data-v-offset', 3);
    $dd->getTrigger()->addCssClass('button', 'radius');
    $dd->getDropdown()->addCssClass('shadow', 'radius');
    $sb->setInitialState($_GET);
    return $dd;
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
    $this->msgTypeSelector = new Select('type');
    //$this->msgTypeSelector->addCssClass('input-group-field');
    $this->msgTypeSelector->appendOption('s', 'Singular form');
    $this->msgTypeSelector->appendOption('p', 'Plural form');
    $this->msgTypeSelector->appendOption('sp', 'Singular or Plural form');

    $this->msgTypeSelector->setSubmitValue('sp');
  }

  public function buildFieldTypeSelector() {
    $this->fieldTypeSelector = new Select('part');
    //$this->fieldTypeSelector->addCssClass('input-group-field');
    $this->fieldTypeSelector->appendOption('i', 'ID of');
    $this->fieldTypeSelector->appendOption('t', 'Translation of');
    $this->fieldTypeSelector->appendOption('it', 'ID or Translation of');
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
    $inputGroup1->append($this->fieldTypeSelector);
    $inputGroup1->append($this->msgTypeSelector);

    $form->append($inputGroup1);
    $inputrow = new FormRow();
    $inputrow->addCssClass('foo');

    $inputGroup = new InputGroup();
    $inputGroup->appendLabel('Containing text');
    $inputGroup->append($this->buildOptionSelector());
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
