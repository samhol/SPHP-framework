<?php

namespace Sphp;

use Sphp\Html\AbstractComponentGenerator;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Foundation\Sites\Forms\Buttons\SubmitButton;
use Sphp\Html\Foundation\Sites\Forms\Inputs\Radioboxes;

class GettextForm extends AbstractComponentGenerator {

  /**
   *
   * @var GridForm 
   */
  private $form;

  /**
   * @var Collection 
   */
  private $data;

  /**
   * @var GettextTable
   */
  private $tableGenerator;

  public function __construct(Collection $gettextData) {
    $this->tableGenerator = new GettextTable($gettextData);
  }

  public function getData(): Collection {
    return $this->data;
  }

  public function setData(Collection $data) {
    $this->data = $data;
    $this->tableGenerator->setData($data);
    return $this;
  }

  public function generate(): Html\ContentInterface {

    $form = new GridForm('manual/gettext/index.php', 'get');
    $form->addCssClass('sphp-gettext-form');


    $row = new FormRow();
    $typeSelector = new Radioboxes('type', [0b1 => 'singular:', 0b10 => 'plural:', 0b11 => 'Both:']);
    $typeSelector->setValue(['type' => 0b11]);
    $row->appendColumn($typeSelector, 12, false, 4, 5);

    $form->append($row);

    $row1 = new FormRow();
    $row->appendColumn(new \Sphp\Html\Foundation\Sites\Forms\Inputs\TextColumn('query'), 12, false, 7, 6);
    $row->appendColumn(new SubmitButton('submit'), 12, false, 1);

    $form->append($row1);
    $form->append($this->tableGenerator->generate());
    return $form;
  }

}
