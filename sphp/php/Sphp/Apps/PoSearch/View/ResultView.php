<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\View;

use Sphp\Html\AbstractContent;
use Sphp\Html\Tags;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Bootstrap\Layout\Container;

/**
 * The ResultView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResultView extends AbstractContent {

  /**
   * @var Entry[]
   */
  private array $entries;
  private int $firsNum = 1;

  /**
   * 
   * @param array $entries
   * @param int $firstNum
   */
  public function __construct(array $entries, int $firstNum = 1) {
    $this->entries = $entries;
    $this->firsNum = $firstNum;
  }

  public function __destruct() {
    unset($this->entries);
  }

  public function getHtml(): string {
    $out = new Container();
    $out->addCssClass('p-1 po');
    $num = $this->firsNum;
    foreach ($this->entries as $entry) {
      $row = $out->appendRow();
      $row->addCssClass('gx-1 mb-1');
      if ($num % 2 === 0) {
        $row->addCssClass('even entry');
      } else {
        $row->addCssClass('odd entry');
      }
      $col = $row->appendColumn(Tags::div('#' . $num++)->addCssClass('row-no'))->default('auto');
      $col->default('auto');
      //$col->content()->addCssClass('text-end');
      if ($entry->isPlural()) {
        $row->appendColumn(new PluralEntryView($entry))->addCssClass('px-1');
      } else {
        $row->appendColumn(new SingularEntryView($entry));
      }
    }
    return $out->getHtml();
  }

}
