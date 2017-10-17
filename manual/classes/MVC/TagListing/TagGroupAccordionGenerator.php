<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SingleAccordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

/**
 * Description of TagListAccordionGenerator
 *
 * @author samih
 */
class TagGroupAccordionGenerator implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * @var Group
   */
  private $data;

  public function __construct(Group $data) {
    $this->data = $data;
  }

  public function getHtml(): string {
    $accordions = (new SingleAccordion())
            ->allowAllClosed(true)
            ->allowMultiExpand(true)
            ->addCssClass('html-ref-tables');
      $accordions->append(new Pane($this->data->getName(), new TagGroupTable($this->data)));

    return $accordions->getHtml();
  }

}
