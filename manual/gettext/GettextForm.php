<?php

namespace Sphp;

use Sphp\Html\AbstractComponentGenerator;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Foundation\Sites\Forms\Inputs\Checkboxes;
use Iterator;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\Foundation\Sites\Buttons\ButtonStyleAdapter;

class GettextForm extends AbstractComponentGenerator {

  /**
   *
   * @var GridForm 
   */
  private $form;

  /**
   * @var Iterator 
   */
  private $data;

  /**
   * @var GettextTable
   */
  private $tableGenerator;

  public function __construct(Iterator $gettextData) {
    $this->tableGenerator = new GettextTable($gettextData);
  }

  public function getData(): Iterator {
    return $this->data;
  }

  public function setData(Iterator $data) {
    $this->data = $data;
    $this->tableGenerator->setData($data);
    return $this;
  }

  public function getTableGenerator(): GettextTable {
    return $this->tableGenerator;
  }

  public function setTableGenerator(GettextTable $tableGenerator) {
    $this->tableGenerator = $tableGenerator;
    return $this;
  }

  public function generate(): Html\Content {

    $form = new GridForm('manual/gettext/index.php', 'get');

    $form->addCssClass('sphp-gettext-form');


    $row = new FormRow();
    $typeSelector = new Checkboxes('type', [0b1 => 'singular', 0b10 => 'plural', 0b100 => 'original', 0b1000 => 'translation']);
    $typeSelector->setValue(['type' => 0b11]);
    $row->appendColumn($typeSelector, ['small-12', 'large-4', 'xlarge-5']);

    $form->append($row);

    $row1 = new FormRow();
    $row->append(InputColumn::text('query', null, ['small-12', 'large-7', 'xlarge-6']));
    $row->appendColumn(ButtonStyleAdapter::submitter('submit'), ['small-12', 'large-1']);

    $form->append($row1);
    $form->append($this->tableGenerator->generate());
    return $form;
  }

}
