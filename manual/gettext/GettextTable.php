<?php

namespace Sphp;

use Sphp\Html\AbstractComponentGenerator;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\I18n\Gettext\PluralGettextData;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Tr;

class GettextTable extends AbstractComponentGenerator {

  /**
   * @var Collection 
   */
  private $data;

  /**
   * @var int 
   */
  private $i = 1;

  public function __construct(Collection $gettextData = null) {
    $this->data = $gettextData;
  }

  public function setFirstRowNumber($i) {
    $this->i = $i;
    return $this;
  }

  public function getData(): Collection {
    return $this->data;
  }

  public function setData(Collection $data) {
    $this->data = $data;
    return $this;
  }

  public function generate(): Html\ContentInterface {
    $i = $this->i;
    $table = new Table();
    $table->addCssClass('po-table')
            ->thead()->appendHeaderRow(['Row:', 'Original:', 'Translation:']);
    foreach ($this->data as $obj) {
      $tr = new Tr();
      if ($obj instanceof PluralGettextData) {
        $tr->appendTh($i, 'rowgroup', 1, 2);
        $tr->appendTd($obj->getMessageId());
        $tr->appendTd($obj->getTranslation());
        $table->tbody()->append($tr);
        $tr1 = new Tr();
        $tr1->appendTd($obj->getPluralId());
        $tr1->appendTd($obj->getPluralTranslation());
        $table->tbody()->append($tr1);
      } else {
        $tr->appendTh($i);
        $tr->appendTd($obj->getMessageId());
        $tr->appendTd($obj->getTranslation());
        $table->tbody()->append($tr);
      }
      $i++;
    }
    return $table;
  }

}
