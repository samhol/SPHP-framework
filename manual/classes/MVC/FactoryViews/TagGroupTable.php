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

  function generateTagTable(): Table {
    $table = (new Table())
            ->addCssClass('factory-tables', 'stack');
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
    $span = new \Sphp\Html\Span('w3cschools link:');
    $span->addCssClass('hide-for-large');
    $tr->appendTd($span. $cells->getW3cLink());  
    $span->setContent('Factory call: ');
    $tr->appendTd($span. $cells->getFactoryCallLink());  
    $span->setContent('Object type: ');
    $tr->appendTd($span. $cells->getObjectTypeLink());  
    return $tr;
  }

  public function getHtml(): string {
    return $this->generateTagTable()->getHtml();
  }

}
