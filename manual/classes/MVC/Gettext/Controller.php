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

/**
 * Description of Controller
 *
 * @author Sami
 */
class Controller {

  /**
   *
   * @var PoFileIterator
   */
  private $poFileParser;

  public function __construct(PoFileIterator $poFileParser) {
    $this->poFileParser = $poFileParser;
  }

  public function filterData(): PoFileIterator {
    $msgType = filter_input(INPUT_GET, 'msg_type', FILTER_SANITIZE_STRING);
    var_dump($msgType);
    if ($msgType === 'singular') {
      echo 'singular';
      $pos = $this->poFileParser->getSingulars();
    } else if ($msgType === 'plural') {
      $pos = $this->poFileParser->getPlurals();
    } else {
      $pos = $this->poFileParser;
    }
    $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($query)) {
      //$query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
      echo "Searching for : $query";
      $cond1 = function(Entry $e) {
        $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
        return mb_strpos($e->getMsgStr(), $query) !== false;
      };
      $pos = $pos->filter($cond1);
    }
    $cond = function(Entry $a, Entry $b) {
      return strcmp($a->getMsgId(), $b->getMsgId());
    };
    $pos->sort($cond);
    return $pos;
  }

  public function buildView() {

    $form = new GettextForm();

    $table = new GettextTable();

    echo $form->getHtml();
    echo $table->generate($this->filterData());
  }

}
