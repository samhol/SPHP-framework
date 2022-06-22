<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Events;

use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Apps\Calendars\Diaries\Events\SingleEvent;
use Sphp\Html\Layout\Section;

/**
 * Description of EventViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScheduleViewBuilder {

  /**
   * Implements function call
   * 
   * @param DiaryDate $date
   * @return string
   */
  public function __invoke(DiaryDate $date): string {
    return $this->build($date);
  }

  public function build(DiaryDate $date): string {
    $tasks = $date->getByType(SingleEvent::class);
    if (count($tasks)) {
      $section = new Section();
      $section->addCssClass('group', 'tasks');
      $output = new \Sphp\Html\Div();
      $section->appendH3('Tasks and Events:');
      $section->append($output);
      foreach ($tasks as $task) {
        if ($task instanceof \Sphp\Apps\Calendars\Diaries\Events\SingleEvent) {
          $output->append(new SingleEventView($task));
        } else {
          $output->append($task);
        }
      }
      //$acc = new Accordion();
      //$acc->appendPane('Tasks', $output);
      return "$section";
    } else {
      return '';
    }
  }

}
