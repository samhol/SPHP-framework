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
  private $options;

  /**
   * @var Input
   */
  private $msgTypeSelector;

  /**
   * @var Input
   */
  private $queryField;

  public function __construct() {
    //$this->buildMessageTypeSelector();
    $this->buildOptionSelector();
    $this->buildQueryField();
  }

  public function setInitialValues(string $msgType = null, string $part = null, string $query = null) {
    
  }

  private function buildOptionSelector() {
    $sb = new SwitchBoard;
    $sb->setToggler('Check all', 'all', 1);
    $sb->appendNewSwitch('Singular', 'singular', 1);
    $sb->appendNewSwitch('Plural', 'plural', 1);
    $sb->appendNewSwitch('Messages', 'msg', 1);
    $sb->appendNewSwitch('Message IDs', 'msgid', 1);
    $sb->setDescription('Select used Gettext fields');
    $dd = new Dropdown(new \Sphp\Html\Forms\Buttons\Button('Options'), $sb);
    $dd->closeOnBodyClick(true);
    $dd->setOption('data-v-offset', 3);
    $dd->getTrigger()->addCssClass('button1', 'radius', 'dropdown');
    $dd->getDropdown()->addCssClass('shadow', 'radius');
    $sb->setInitialState($_GET);
    $this->options = $sb;
    return $dd;
  }

  public function setQueryFieldValue(string $value = null) {
    $this->queryField->setInitialValue($value);
    return $this;
  }

  public function setOptions(array $opts = []) {
    $this->options->setInitialValue($opts);
    return $this;
  }

  public function setSelectedFieldType(string $value = null) {
    $this->fieldTypeSelector->setInitialValue($value);
    return $this;
  }



  private function buildQueryField() {
    $this->queryField = new TextInput('query');
    $this->queryField->setPlaceholder('Search Gettext');
  }

  public function generate(): GridForm {
    $form = new GridForm('/gettext/', 'get');
    $form->addCssClass('sphp', 'gettext-form');
    $row1 = new FormRow();
   // $row1->addCssClass();
    //$inputGroup1 = new InputGroup();
    //$inputGroup1->appendLabel('Search');
    $row2 = new FormRow();
    //$inputGroup1->append($this->fieldTypeSelector);
    //$inputGroup1->append($this->msgTypeSelector);

   // $form->append($inputGroup1);
    $inputrow = new FormRow();
  //  $inputrow->addCssClass('foo');

    $inputGroup = new InputGroup();
    $inputGroup->appendLabel('Search: ');
    $inputGroup->appendButton($this->buildOptionSelector());
    $inputGroup->append($this->queryField);
    $inputGroup->appendSubmitter('<i class="fas fa-search"></i><span class="show-for-sr">search</span>');
    //$inputrow->appendResetter('<i class="fas fa-undo"></i><span class="show-for-sr">reset form</span>')->addCssClass('alert');
    //$row2->appendCell($inputrow);
    //$row2->append($this->queryField);
    //$row2->appendCell(Button::submitter('submit'), ['small-12', 'medium-shrink']);
$row2->appendCell('Search');
    $inputrow->appendCell($inputGroup)->auto();
    $form->append($inputrow);
    return $form;
  }

  public function getHtml(): string {
    return $this->generate()->getHtml();
  }

}
