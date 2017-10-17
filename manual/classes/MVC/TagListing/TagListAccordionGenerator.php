<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

/**
 * Description of TagListAccordionGenerator
 *
 * @author samih
 */
class TagListAccordionGenerator implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Groups
   */
  private $data;

  public function __construct(Groups $data) {
    $this->data = $data;
  }

  public function getHtml(): string {
    $accordions = (new Accordion())
            ->allowAllClosed(true)
            ->allowMultiExpand(true)
            ->addCssClass('html-ref-tables');
    foreach ($this->data as $val) {
      $accordions->append(new Pane($val->getName(), new TagGroupTable($val)));
    }
    return $accordions->getHtml();
  }

}
