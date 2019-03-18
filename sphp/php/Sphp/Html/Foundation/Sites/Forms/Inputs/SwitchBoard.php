<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Label;
use Sphp\Html\Div;

/**
 * Implements a switchboard
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SwitchBoard extends AbstractComponent {

  /**
   * @var SwitchBox 
   */
  private $toggler;

  /**
   * @var SwitchBox[] 
   */
  private $switches;

  /**
   * @var Div 
   */
  private $description;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('callout', 'sphp', 'switch-board');
    $this->setAttribute('data-switch-board', true);
    $this->switches = [];
    $this->description = new Div();
    $this->description->addCssClass('description');
    $this->setToggler('Toggle All');
  }

  public function __destruct() {
    unset($this->toggler, $this->switches, $this->description);
    parent::__destruct();
  }

  public function setDescription($description) {
    $this->description->resetContent($description);
    return $this;
  }

  /**
   * 
   * @param  string $label
   * @param  string $name
   * @param  type $value
   * @return SwitchBox
   */
  public function setToggler(string $label, string $name = null, $value = null): SwitchBox {
    $toggler = new SwitchBox($name, $value);
    $toggler->setScreenReaderLabel($label);
    $this->setToggleSwitch($toggler);
    return $toggler;
  }

  /**
   * 
   * @param  SwitchBox $toggler
   * @return SwitchBox
   */
  public function setToggleSwitch(SwitchBox $toggler): SwitchBox {
    $toggler->getInput()->setAttribute('data-toggle-all', true);
    $this->toggler = $toggler;
    return $toggler;
  }

  public function appendSwitch(SwitchBox $switch) {
    $switch->setSize('small');
    $this->switches[] = $switch;
    return $this;
  }

  public function appendNewSwitch(string $label, string $inputName = null, $inputValue = null): SwitchBox {
    $switch = new SwitchBox($inputName, $inputValue);
    $switch->setScreenReaderLabel($label);
    $this->appendSwitch($switch);
    return $switch;
  }

  protected function buildSwitchContainerFor(SwitchBox $switch): string {
    $output = '<div class="switch-toggle-wrapper">';
    $output .= $switch;
    $output .= new Label($switch->getScreenReaderLabel(), $switch->getInput());
    $output .= '</div>';
    return $output;
  }

  public function contentToString(): string {
    $toggler = $this->buildSwitchContainerFor($this->toggler);
    $options = new Div();
    $options->addCssClass('options');
    foreach ($this->switches as $switch) {
      $options->append($this->buildSwitchContainerFor($switch));
    }
    return $this->description . $toggler . '<hr>' . $options;
  }

}
