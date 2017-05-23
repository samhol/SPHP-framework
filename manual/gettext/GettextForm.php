<?php

namespace Sphp;

use Sphp\Html\AbstractComponentGenerator;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Foundation\Sites\Forms\Buttons\SubmitButton;

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

  private function generateSearchComponents() {
    $row = new FormRow();
    $typeSelector = new \Sphp\Html\Forms\Inputs\Radioboxes('type', ['Both:', 'singular', 'plural']);
    $typeSelector->setValue(['type' => 0]);
    $row->appendColumn(new \Sphp\Html\Forms\Inputs\Radioboxes('type', ['Both:', 'singular', 'plural']), 12, false, 4, 5);
    $row->appendColumn(new \Sphp\Html\Foundation\Sites\Forms\Inputs\TextColumn('query'), 12, false, 7, 6);
    $row->appendColumn(new SubmitButton('submit'), 12, false, 1);
    return $row;
  }

  public function generate(): Html\ContentInterface {
    $this->form = new GridForm('manual/gettext/index.php', 'get');
    $this->form->addCssClass('sphp-gettext-form');
    $this->form->append($this->generateSearchComponents());
    $this->form->append($this->tableGenerator->generate());
    return $this->form;
  }

}
