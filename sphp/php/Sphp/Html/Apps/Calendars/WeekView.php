<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

/**
 * Description of WeekView
 *
 * @author Sami
 */
class WeekView extends AbstractComponent {

  public function __construct() {
    parent::__construct('div');
    $this->week = date('W');
    $this->weekCell = new \Sphp\Html\Div($this->week);
    $this->dayBlocks = new BlockGrid(range(1, 7), 7);
  }

  public function contentToString() {
    return $this->weekCell->getHtml() . $this->dayBlocks->getHtml();
  }

}
