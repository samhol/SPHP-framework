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
    $this->query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);

    $options['all'] = filter_has_var(INPUT_GET, 'all');
    $options['singular'] = filter_has_var(INPUT_GET, 'singular');
    $options['plural'] = filter_has_var(INPUT_GET, 'plural');
    $options['msg'] = filter_has_var(INPUT_GET, 'msg');
    $options['msgid'] = filter_has_var(INPUT_GET, 'msgid');

    $this->options = (object) $options;
    $this->options->allParts = $this->options->msg && $this->options->msgid || $this->options->all;
    echo '<pre>';
    var_dump($this->options, $this->query);
    echo '</pre>';
  }

  /**
   * 
   * @return TraversableCatalog
   */
  private function filterByMessageType(): TraversableCatalog {
    //$msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    if ($this->options->all) {
      $pos = $this->poFileParser;
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

  private function entryTest(Entry $entry) {

    if ($this->options->msgid) {
      $haystack[] = $entry->getMsgId();
      $haystack[] = $entry->getMsgIdPlural();
    } if ($this->options->msg) {
      $haystack = array_merge($entry->getMsgStrPlurals(), $haystack);
      $haystack[] = $entry->getMsgStr();
    }
    echo '<pre>';
    var_dump($entry->isPlural());
    print_r($haystack);
    
  }

  private function filterData(): TraversableCatalog {

    $pos = $this->filterByMessageType();
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    $res = new TraversableCatalog;
    if (!empty($this->query)) {
      foreach ($pos->toArray() as $entry) {
       
          $this->entryTest($entry);
        
      }
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
