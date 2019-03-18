<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

/**
 * Description of SwitchBoard
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SwitchBoard extends \Sphp\Html\AbstractComponent {

  private $toggler;

  /**
   *
   * @var type 
   */
  private $switches;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('callout', 'sphp', 'switch-board');
    $this->setAttribute('data-switch-board', true);
    $this->switches = [];
    $this->labels = [];
  }

  public function setToggler(string $name, $value, string $label): SwitchBox {
    $this->toggler = new SwitchBox($name, $value);
    $this->toggler->setScreenReaderLabel($label);
    return $this->toggler;
  }

  public function appendSwitch(SwitchBox $switch) {
    $this->switches[] = $switch;
  }
  public function appendNewSwitch(string $name, $value, string $label) {
    $this->toggler = new SwitchBox($name, $value);
    $this->toggler->setScreenReaderLabel($label);
    $this->switches[] = $switch;
  }

  protected function buildSwitchContainerFor(SwitchBox $switch):string {
     $output = '<div class="switch-toggle-wrapper">';
     $output .= $switch;
      $output .=  new \Sphp\Html\Forms\Label($output, $switch->getInput());
    $output .= '</div>';
    return $output;
  }

  public function contentToString(): string {
    $output = $this->toggler->getHtml();
    foreach ($this->switches as $switch) {
      $output.= $this->buildSwitchContainerFor($switch);
    }
    return $output;
  }

}
