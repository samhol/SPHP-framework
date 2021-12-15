<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Sports\Workouts\Exercise;
use Sphp\Apps\Sports\Workouts\WeightLiftingExercise;
use Sphp\Html\Container;
use Sphp\Html\Tags;
use Sphp\Html\PlainContainer;
use Sphp\Html\Sections\Section;
use Sphp\Html\Lists\Ul;

/**
 * Abstract implementation of exercise view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class ExerciseView extends AbstractContent {

  /**
   * @var Exercise
   */
  protected $exercise;

  /**
   * Constructor
   * 
   * @param Exercise $exercise
   */
  public function __construct(Exercise $exercise) {
    $this->exercise = $exercise;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->exercise);
  }

  abstract public function getFieldNames(): array;

  /**
   * Builds exercise pane
   * 
   * @param  Exercise $exercise
   * @return Section exercise pane
   */
  public function buildPane(Exercise $exercise): Section {
    $pane = new Section();
    $pane->addCssClass('exercise');
    $pane->appendH3($this->buildTitleContent($exercise));
    $pane->append($this->buildContent($exercise));
    return $pane;
  }

  /**
   * Builds exercise pane title content
   * 
   * @param  Exercise $exercise
   * @return Container exercise pane title content
   */
  public function buildTitleContent(Exercise $exercise): Container {
    $title = new PlainContainer;
    $title[] = new ExerciseIconView($exercise);
    $title[] = Tags::span($exercise->getName());
    if ($exercise->getDescription() !== '') {
      $title->append(Tags::span(" ({$exercise->getDescription()})")->addCssClass('small'));
    }
    return $title;
  }

  public function totalsToHtml(): string {

    $list = new Ul();
    $list->addCssClass('no-bullets');
    foreach ($this->totalsToArray() as $key => $value) {
      $list->append("<strong>$key:</strong> <var>$value</var>");
    }
    return "$list";
  }

  /**
   * Builds exercise content
   * 
   * @param  Exercise $exercise
   * @return PlainContainer exercise content
   */
  public function buildContent(Exercise $exercise): PlainContainer {
    $container = new PlainContainer();
    if ($exercise->count() > 1 || $exercise instanceof WeightLiftingExercise) {

      $tableBuilder = new \Sphp\Html\Tables\TableBuilder;
      $ln = new \Sphp\Html\Tables\LineNumberer();
      $ln->setLabel('set:');
      $tableBuilder->addTableFilter($ln);

      $tableBuilder->setTheadData($this->getFieldNames());
      $tableBuilder->setTbodyData($exercise->setsToArray());
      $table = $tableBuilder->buildTable();
      $table->addCssClass('table table-striped table-hover table-sm');
      $container->append($table);
    }
    $container->append($this->totalsToHtml($exercise));

    return $container;
  }

  public function getHtml(): string {
    return $this->buildPane($this->exercise)->getHtml();
  }

  public function totalsToArray(): array {
    return [];
  }

}
