<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views\Utils;

use Sphp\Html\Tables\TableBuilder;
use Sphp\Html\Tables\LineNumberer;
use Sphp\Html\Tables\Table;
use Sphp\Apps\Sports\Workouts\Exercise;
use Sphp\Html\Container;
use Sphp\Html\Tags;
use Sphp\Html\PlainContainer;
use Sphp\Bootstrap\Components\Accordions\ContentPane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Layout\Div;

/**
 * The ExerciseViews class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExerciseViews {

  /**
   * @var Exercise
   */
  private $exercice;

  /**
   * Constructor
   * 
   * @param Exercise $exercise
   */
  public function __construct(Exercise $exercise) {
    $this->exercice = $exercise;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->exercice);
  }

  /**
   * Builds exercise pane title content
   * 
   * @return Container exercise pane title content
   */
  public function buildTitleContent(): Container {
    $title = new PlainContainer;
    $title[] = new ExerciseIconView($this->exercice);
    $title[] = Tags::span($this->exercice->getName());
    if ($this->exercice->getDescription() !== '') {
      $title->append(Tags::span("({$this->exercice->getDescription()})")->addCssClass('small ms-2'));
    }
    return $title;
  }

  public function build(): Table {
    $tableBuilder = new TableBuilder;
    $ln = new LineNumberer();
    $ln->setLabel('set');
    $tableBuilder->addTableFilter($ln);
    $tableBuilder->setTheadData($this->exercice->getSetNames());
    $tableBuilder->setTbodyData($this->exercice->setsToArray());
    $table = $tableBuilder->buildTable();
    $table->addCssClass('table table-striped table-hover table-sm');
    return $table;
  }

  public function totalsToHtml(): string {
    $div = new  Div('<strong>summary:</strong>');
    $list = new Ul();
    foreach ($this->exercice->getTotals() as $key => $value) {
      $list->append("<strong>$key:</strong> <var>$value</var>");
    }
    $list->addCssClass('no-bullets');
    $div->append($list);
    return "$div";
  }

  public function buildPane(): ContentPane {
    return new ContentPane($this->buildTitleContent(), $this->build() . $this->totalsToHtml());
  }

}
