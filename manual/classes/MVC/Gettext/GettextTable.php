<?php

namespace Sphp\Manual\MVC\Gettext;

use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Tr;
use Traversable;

class GettextTable {

  /**
   * @var Traversable 
   */
  private $data;

  /**
   * @var int 
   */
  private $i = 1;

  public function __construct(Traversable $gettextData = null) {
    $this->data = $gettextData;
  }

  public function setFirstRowNumber($i) {
    $this->i = $i;
    return $this;
  }

  public function getData(): Traversable {
    return $this->data;
  }

  public function setData(Traversable $data) {
    $this->data = $data;
    return $this;
  }

  public function generate(iterable $entries): Table {
    $i = $this->i;
    $this->table = new Table();
    $this->table->addCssClass('po-table')
            ->thead()->appendHeaderRow(['Type','id:', 'Translation:']);
    foreach ($entries as $entry) {
      $this->insertEntryTo($entry);
    }
    return $this->table;
  }

  protected function insertEntryTo(\Sepia\PoParser\Catalog\Entry $entry) {
    if ($entry->isPlural()) {
      $translations = $entry->getMsgStrPlurals();
      $tr = new Tr();
      $tr->appendTh('plural', 1, 2, 'rowgroup');
      $tr->appendTd($entry->getMsgId());
      $tr->appendTd($translations[0]);
      $this->table->tbody()->append($tr);
      $tr = new Tr();
      $tr->appendTd($entry->getMsgIdPlural());
      $tr->appendTd($translations[1]);
      $this->table->tbody()->append($tr);
    } else {
      $tr = new Tr();
      $tr->appendTh('singular', 1, 1, 'row');
      $tr->appendTd($entry->getMsgId());
      $tr->appendTd($entry->getMsgStr());
      $this->table->tbody()->append($tr);
    }
  }

  public function getHtml(): string {
    return $this->generate()->getHtml();
  }

}
