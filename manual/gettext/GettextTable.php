<?php

namespace Sphp\Html\Tables;

use Sphp\Html\ContentInterface;
use Sphp\Core\I18n\Gettext\PoFileParser;
use Sphp\Core\I18n\Gettext\GettextData;
use Sphp\Core\I18n\Gettext\PluralGettextData;

class GettextTable implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var Table
   */
  private $table;
  private $i = 1;

  public function __construct(PoFileParser $gettextData) {
    $this->table = new Table();
    $this->table->thead()->append(['Row:', 'Original:', 'ranslation:']);
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
    $tr->append(new Th($this->i, 'rowgroup', 1, 2));
    $tr->append($obj->getMessageId());
    $tr->append($obj->getTranslation());
    $this->table->tbody()->append($tr);
    $tr1 = new Tr();
    $tr1->append($obj->getPluralId());
    $tr1->append($obj->getPluralTranslation());
    $this->table->tbody()->append($tr1);
  }

  public function getHtml() {
    return $this->table->getHtml();
  }

}
