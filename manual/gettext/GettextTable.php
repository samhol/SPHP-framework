<?php

namespace Sphp;

use Sphp\Html\ContentInterface;
use Sphp\I18n\Gettext\PoFileIterator;
use Sphp\I18n\Gettext\GettextData;
use Sphp\I18n\Gettext\PluralGettextData;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Th;

class GettextTable implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var GridForm 
   */
  private $form;

  /**
   *
   * @var Table
   */
  private $table;
  private $i = 1;

  public function __construct($gettextData) {
    $row = new \Sphp\Html\Foundation\Sites\Forms\FormRow();
    $typeSelector = new \Sphp\Html\Forms\Inputs\Radioboxes('type', ['Both:', 'singular', 'plural']);
    $typeSelector->setValue(['type' => 0]);
    $row->appendColumn(new \Sphp\Html\Forms\Inputs\Radioboxes('type', ['Both:', 'singular', 'plural']), 12, false, 4, 3);
    $row->appendColumn(new \Sphp\Html\Foundation\Sites\Forms\Inputs\TextColumn('search'), 12, false, 7, 8);
    $row->appendColumn(new \Sphp\Html\Foundation\Sites\Forms\Buttons\SubmitButton('submit'), 12, false, 1);
    $this->form = new GridForm('manual/gettext/?action=search', 'get');
    $this->form->append($row);
    $this->table = new Table();
    $this->table->addCssClass('po-table')->thead()->append(['Row:', 'Original:', 'ranslation:']);
    //$body = $this->table->tbody();
    $this->i = 1;
    foreach ($gettextData as $obj) {
      if ($obj instanceof PluralGettextData) {
        $this->pluralRow($obj);
      } else {
        $this->row($obj);
      }
      // $body->append(var_export($obj, true));
      $this->i++;
    }
  }

  private function row(GettextData $obj) {
    $tr = new Tr();
    $tr->append($this->i, 'th');
    $tr->append($obj->getMessageId());
    $tr->append($obj->getTranslation());
    $this->table->tbody()->append($tr);
  }

  private function pluralRow(PluralGettextData $obj) {
    $tr = new Tr();
    $tr->append(new Th($this->i, 1, 2, 'rowgroup'));
    $tr->append($obj->getMessageId());
    $tr->append($obj->getTranslation());
    $this->table->tbody()->append($tr);
    $tr1 = new Tr();
    $tr1->append($obj->getPluralId());
    $tr1->append($obj->getPluralTranslation());
    $this->table->tbody()->append($tr1);
  }

  public function getHtml() {
    return $this->form->getHtml() . $this->table->getHtml();
  }

}
