<?php

/**
 * TagGroupTable.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\Content;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Tr;

/**
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TagGroupTable implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Group
   */
  private $data;

  public function __construct(Group $data) {
    $this->data = $data;
  }

  public function __destruct() {
    unset($this->data);
  }

  public function generateTagTable(): Table {
    $table = (new Table())
            ->addCssClass('factory-table', 'responsive-card-table', 'unstriped');
    $table->thead()
            ->appendHeaderRow(['HTML Tag', 'Factory call', 'Object type']);
    $body = $table->tbody();
    foreach ($this->data as $info) {
      $body->append($this->createRow($info));
    }
    return $table;
  }

  protected function createRow(TagFactoryMethodData $cells): Tr {
    $tr = new Tr();
    $tr->appendTd($cells->getW3cLink())->setAttribute('data-label', 'HTML Tag');
    $tr->appendTd($cells->getFactoryCallLink())->setAttribute('data-label', 'Factory call');
    $tr->appendTd($cells->getObjectTypeLink())->setAttribute('data-label', 'Object type');
    return $tr;
  }

  public function getHtml(): string {
    return $this->generateTagTable()->getHtml();
  }

}
