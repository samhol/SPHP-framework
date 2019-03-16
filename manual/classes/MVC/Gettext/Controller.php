<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\Gettext;

use Sphp\I18n\Gettext\PoFileIterator;
use Sepia\PoParser\Catalog\Entry;


class Controller {

  /**
   *
   * @var PoFileIterator
   */
  private $poFileParser;

  public function __construct(PoFileIterator $poFileParser) {
    $this->poFileParser = $poFileParser;

    $this->msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    $this->msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    $this->query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
  }

  private function filterByMessageType(): PoFileIterator {
    //$msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    var_dump($this->msgType);
    if ($this->msgType === 'singular') {
      echo 'singular';
      $pos = $this->poFileParser->getSingulars();
    } else if ($this->msgType === 'plural') {
      $pos = $this->poFileParser->getPlurals();
    } else {
      $pos = $this->poFileParser;
    }
    return $pos;
  }

  public function filterData(): PoFileIterator {

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
