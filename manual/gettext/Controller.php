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
    if ($msgType === 'singular') {
      $pos = $this->poFileParser->getSingulars();
    } else if ($msgType === 'plural') {
      $pos = $this->poFileParser->getPlurals();
    } else {
      $pos = $this->poFileParser;
    }
    if (isset($_GET['msgstr'])) {
      $msgstr = filter_input(INPUT_GET, 'msgstr', FILTER_SANITIZE_SPECIAL_CHARS);
      echo "Searching for : $msgstr";
      $cond1 = function(Entry $e) {
        $msgId = filter_input(INPUT_GET, 'msgstr');
        return mb_strpos($e->getMsgStr(), $msgId) !== false;
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
