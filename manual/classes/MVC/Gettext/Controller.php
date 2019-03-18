<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\Gettext;

use Sphp\I18n\Gettext\TraversableCatalog;
use Sepia\PoParser\Catalog\Entry;

class Controller {

  /**
   * @var TraversableCatalog
   */
  private $poFileParser;

  /**
   * @var string
   */
  private $part, $msgType;

  public function __construct(TraversableCatalog $poFileParser) {
    $this->poFileParser = $poFileParser;
    $typeRegex = ['options' => ['regexp' => "/^(s|p|sp)+$/", 'default' => 'sp']];
    $this->msgType = filter_input(INPUT_GET, 'type', FILTER_VALIDATE_REGEXP, $typeRegex);
    $partRegex = ['options' => ['regexp' => "/^(i|t|it)+$/", 'default' => 'it']];
    $this->part = filter_input(INPUT_GET, 'part', FILTER_VALIDATE_REGEXP, $partRegex);
    $this->query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    $args = array(
        'singular' => FILTER_VALIDATE_BOOLEAN,
        'plural' => FILTER_VALIDATE_BOOLEAN,
        'msg' => FILTER_VALIDATE_BOOLEAN,
        'msgid' => FILTER_VALIDATE_BOOLEAN,
        'all' => FILTER_VALIDATE_BOOLEAN
    );
    $options = filter_input_array(INPUT_GET, $args);
    $this->options = (object) $options;
    echo '<pre>';
    var_dump($this->options);
  }

  /**
   * 
   * @return TraversableCatalog
   */
  private function filterByMessageType(): TraversableCatalog {
    //$msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    var_dump($this->msgType);
    if ($this->options->all) {
      $pos = $this->poFileParser->getSingulars();
    } else {
      if ($this->options->singular || !$this->options->plural) {
        echo 'singular';
        $pos = $this->poFileParser->getSingulars();
      } else if (!$this->options->singular || $this->options->plural) {
        echo 'plural';
        $pos = $this->poFileParser->getPlurals();
      } else {
        echo 'nothing';
        $pos = new TraversableCatalog;
      }
    }
    return $pos;
  }

  private function doQuerySearchForTranslations() {
    $pos = $this->filterByMessageType();
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    foreach ($pos->toArray() as $entry) {
      if ($entry->isPlural()) {
        $plurals = $entry->getMsgStrPlurals();
        //var_dump($plurals[0] === $needle || $plurals[1] === $needle);
        return mb_strpos($plurals[0], $query) !== false || mb_strpos($plurals[1], $query) !== false;
      } else {
        return mb_strpos($entry->getMsgStr(), $query) !== false;
      }
    }
  }

  private function doQuerySearchForMessages() {
    $pos = $this->filterByMessageType();
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    foreach ($pos->toArray() as $entry) {
      if ($entry instanceof Entry) {
        if ($entry->isPlural()) {
          //var_dump($plurals[0] === $needle || $plurals[1] === $needle);
          return mb_strpos($entry->getMsgId(), $query) !== false || mb_strpos($entry->getMsgIdPlural(), $query) !== false;
        } else {
          return mb_strpos($entry->getMsgId(), $query) !== false;
        }
      }
    }
  }

  public function filterData(): TraversableCatalog {

    $pos = $this->filterByMessageType();
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($query)) {
      $pos = $pos->filterByTranslation($query);
    }
    $cond = function(Entry $a, Entry $b) {
      return strcmp($a->getMsgId(), $b->getMsgId());
    };
    $pos->sort($cond);
    return $pos;
  }

  public function buildView() {

    $form = new GettextForm();
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    $form->setQueryFieldValue($query);
    $table = new GettextTable();

    echo $form->getHtml();
    echo $table->generate($this->filterData());
  }

}
