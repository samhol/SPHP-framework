<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views;

use Sphp\Html\Forms\Form;
use Sphp\Bootstrap\Components\ToolBar;
use Sphp\DateTime\ImmutableDate;
use Sphp\Html\Forms\Inputs\TextInput;

/**
 * Class WorkoutSelectorForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WorkoutSelectorForm {

  public function build(ImmutableDate $date = null) {
    $val = null;
    if ($date !== null) {
      $val = $date->format('Y-m-d');
    }
    $form = new Form('/workouts', 'get');
    $tb = new ToolBar('Daily Workouts selection tools');
    $tb->addCssClass('m-2');
    $prev = $date->jumpDays(-1)->format('Y-m-d');
    $lGroup = $tb->appendHyperlink("/workouts/?date=$prev", '<i class="fas fa-caret-left fa-lg"></i>');
    $lGroup->addCssClass('mr-1 mb-1');
    $input = new TextInput('date', $val, 10, 10);
    $input->addCssClass('form-control');
    $group = $tb->appendInput($input);
    $group->addCssClass('mr-1 mb-1');
    $group->prependLabel('Date: ')->setFor($input);

    $next = $date->jumpDays(1)->format('Y-m-d');
    $tb->appendHyperlink("/workouts/?date=$next", '<i class="fas fa-caret-right fa-lg"></i>')->addCssClass('mr-1 mb-1');
    $submitter = new \Sphp\Html\Forms\Buttons\SubmitButton('<i class="fas fa-search"></i> <strong>FIND</strong>');
    $submitter->addCssClass('btn-success');
    $tb->appendButton($submitter)->addCssClass('mr-1 mb-1');
    $form->append($tb);
    return $form;
  }

}
