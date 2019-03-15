<?php

namespace Sphp\Manual\MVC\Gettext;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Foundation\Sites\Forms\Inputs\Checkboxes;
use Sphp\Html\Foundation\Sites\Forms\Inputs\BasicInputCell;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Foundation\Sites\Forms\Inputs\Radioboxes;

class GettextForm {

  use \Sphp\Html\ContentTrait;

  /**
   * @var GettextTable
   */
  private $fieldData;

  public function __construct() {
    
  }

  public function setFields(array $fieldData) {
    $this->fieldData = $fieldData;
  }

  
  public function buildMessageTypeSelector(): \Sphp\Html\Forms\Inputs\Input {
    $typeSelector1 = new Radioboxes('msg_type', ['singular' => 'Singular', 'plural' => 'Plural', 'singular+plural' => 'Both']);
    $typeSelector1->setLegend('Message type:');
    $typeSelector1->setSubmitValue('singular+plural');
    return $typeSelector1;
  }
  public function generate(): GridForm {

    $form = new GridForm('/gettext/', 'get');

    $form->addCssClass('sphp', 'gettext-form');


    $row1 = new FormRow();
    $row2 = new FormRow();
    $typeSelector1 = new Radioboxes('msg_type', ['singular' => 'Singular', 'plural' => 'Plural', 'singular+plural' => 'Both']);
    $typeSelector1->setLegend('Message type:');
    $typeSelector = new Radioboxes('type', ['id' => 'ID', 'translation' => 'Translation', 'original+translation' => 'Both']);
    $typeSelector->setLegend('Search from:');
    $typeSelector->setSubmitValue(['type' => 0b11]);
    $row1->appendCell($this->buildMessageTypeSelector(), ['small-12', 'medium-shrink']);
    $row1->appendCell($typeSelector, ['small-12', 'medium-shrink']);

    $form->append($row1);

    $row2->append(BasicInputCell::text('query', null, ['small-12', 'medium-auto']));
    $row2->appendCell(Button::submitter('submit'), ['small-12', 'medium-shrink']);

    $form->append($row2);
    return $form;
  }

  public function getHtml(): string {
    return $this->generate()->getHtml();
  }

}
