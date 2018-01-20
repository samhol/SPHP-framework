<?php

/**
 * TagGroupTable.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\Content;
use Sphp\Html\Tables\Table;

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
            ->addCssClass('html-to-php');
    $table->thead()
            ->appendHeaderRow(['HTML Tag', 'Factory call', 'Object type']);
    $body = $table->tbody();
    foreach ($this->data as $info) {
      $body->appendBodyRow($info->toArray());
    }
    return $table;
  }

  public function getHtml(): string {
    return $this->generateTagTable()->getHtml();
  }

}
