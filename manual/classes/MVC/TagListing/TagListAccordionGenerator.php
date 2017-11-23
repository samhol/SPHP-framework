<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\ContentInterface;

/**
 * Description of TagListAccordionGenerator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TagListAccordionGenerator implements ContentInterface {

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
