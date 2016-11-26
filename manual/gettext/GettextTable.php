<?php

namespace Sphp\Html\Tables;

use Sphp\Html\ContentInterface;

class GettextTable implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var Table
   */
  private $table;

  public function __construct(array $gettextData = []) {
    $this->table = new Table();
    $this->table->thead()->append(["Row:", "Form:", "English:", "Finnish translation:"]);
    $body = $this->table->tbody();
  }

  public function getHtml() {
    return $this->table->getHtml();
  }

}
