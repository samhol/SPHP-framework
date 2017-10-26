<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Tables\Table;

/**
 * Description of TagListAccordionGenerator
 *
 * @author samih
 */
class TagGroupTable implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Groups
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
            ->appendHeaderRow(['HTML Tag', 'Function call and Object type']);
    $body = $table->tbody();
    foreach ($this->data as $info) {
      $c = [];
      //$linkText = "&lt;" . $info->getTagName() . "&gt;";
      $c[] = $info->getW3schoolsLink();
      $c[] = Apis::sami()->classLinker($info->getObjectType())->getLink($info->getDocumentCall() . ": ".$info->getObjectType(), "returns " . $info->getObjectType());
      $body->appendBodyRow($c);
    }
    return $table;
  }

  public function getHtml(): string {
    return $this->generateTagTable()->getHtml();
  }

}
