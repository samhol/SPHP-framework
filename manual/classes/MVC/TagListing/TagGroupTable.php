<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

use Sphp\Html\Document;
use Sphp\Html\Adapters\QtipAdapter;
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
   *
   * @var Groups
   */
  private $data;

  public function __construct(Group $data) {
    $this->data = $data;
  }

  function generateTagTable(): Table {
    $table = (new Table())
            ->addCssClass('html-to-php');
    $table->thead()
            ->appendHeaderRow(['HTML Tag', 'Function call', 'Description']);
    $body = $table->tbody();
    foreach ($this->data as $info) {
      $c = [];
      $linkText = "&lt;" . $info->getTagName() . "&gt;";
      $c[] = Apis::w3schools()->tag($info->getTagName(), $linkText);
      $c[] = Apis::sami()->classLinker($info->getObjectType())->getLink($info->getDocumentCall(), "returns " . $info->getObjectType());
      $c[] = $info->getDescription();
      $body->appendBodyRow($c);
    }
    return $table;
  }

  public function getHtml(): string {
    return $this->generateTagTable()->getHtml();
  }

}
