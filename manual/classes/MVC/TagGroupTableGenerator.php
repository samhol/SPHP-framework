<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\Document;
use Sphp\Html\Adapters\QtipAdapter;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

/**
 * Description of TagListAccordionGenerator
 *
 * @author samih
 */
class TagGroupTableGenerator {

  /**
   *
   * @var string[] 
   */
  private $data;

  public function __construct(array $data) {
    $this->data = $data;
  }

  function generateTagTable(array $v) {
    foreach($this->data as $param => $description) {
      $component = Document::get($param);
      $tag = $component->getTagName();
    }
    $table = (new Table())
            ->addCssClass('html-to-php');
    $table->thead()
            ->appendHeaderRow(['Parameter', 'HTML Tag', 'PHP type', 'Description']);
    $body = $table->tbody();
    foreach ($v as $data) {
      if (is_string($data)) {
        $body[] = new Th($data, 'colgroup', 4, 1);
      } else {
        $c = array();
        $tag = Document::get($data[0]);
        $ref = new \ReflectionClass($tag);
//$linkText = htmlspecialchars("$tag");
        $linkText = "&lt;" . $tag->getTagName();
        if ($tag->attrExists("type")) {
          $linkText .= ' type="' . $tag->getAttr("type") . '"';
        }
        $linkText .= "&gt;";
        $param = new \Sphp\Html\Span("$data[0]");
        $tooptipText = "Document::get(\"$data[0]\")";
        $c[] = new QtipAdapter($param, $tooptipText);
        $c[] = Apis::w3schools()->tag($tag->getTagName(), $linkText);
        $text = $ref->getNamespaceName() . "\\<b>" . $ref->getShortName() . "</b>";
        $c[] = Apis::sami()->classLinker($ref->getName(), $text)->getLink();
        $c[] = $data[1];
        $body->appendBodyRow($c);
      }
    }
    return "$table";
  }

  public function build() {
//use Sphp\Html\Programming\Script as Script;
    $accordions = (new Accordion())
            ->allowAllClosed(true)
            ->allowMultiExpand(true)
            ->addCssClass('html-ref-tables');
    foreach ($p as $val) {
      $accordions->append(new Pane($val[0], $generateTagTable($val[1])));
// $accordion = new SingleAccordion($val[0], $generateTagTable($val[1]));
// $accordion->body()->addCssClass("sphp-padding-1");
// $accordion->printHtml();
    }
    $accordions->printHtml();
  }

}
