<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Forms;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Layout\Div;

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
   * @var SwitchInput 
   */
  private SwitchInput $toggler;

  /**
   * @var SwitchInput[] 
   */
  private array $switches;

  /**
   * @var Div 
   */
  private $description;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('sphp', 'switch-board');
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

  /**
   * 
   * @param  mixed $description
   * @return $this for a fluent interface
   */
  public function setDescription($description) {
    $this->description->resetContent($description);
    return $this;
  }

  /**
   * 
   * @param  array $state
   * @return $this for a fluent interface
   */
  public function setInitialState(array $state = []) {
    foreach ($this->switches as $switch) {
      $stripped = str_replace('[]', '', $switch->getName());
      if (array_key_exists($stripped, $state)) {
        //echo $stripped . "<pre>";
        //var_dump($state[$stripped], $switch->getSubmitValue());
        //var_dump(in_array($switch->getSubmitValue(), $state[$stripped]));
        // echo "</pre>";
        $switch->setChecked(in_array($switch->getSubmitValue(), $state[$stripped]));
      } //(array_key_exists($switch->getName(), $state)) {
    }
    return $this;
  }

  /**
   * 
   * @param  string $label
   * @param  string $name
   * @param  type $value
   * @return SwitchBox
   */
  public function setToggler(string $label, string $name = null, $value = null): SwitchInput {
    $toggler = SwitchInput::checkbox($name, $value, $label);
    // $toggler->setScreenReaderLabel($label);
    $this->setToggleSwitch($toggler);
    return $toggler;
  }

  /**
   * 
   * @param  SwitchBox $toggler
   * @return SwitchBox
   */
  public function setToggleSwitch(SwitchInput $toggler): SwitchInput {
    $toggler->getInput()->setAttribute('data-toggle-all', true);
    $this->toggler = $toggler;
    return $toggler;
  }

  public function appendText(string $text) {
    //$switch->setSize('small');
    $div = new Div($text);
    $div->addCssClass('text');
    $this->switches[] = $div;
    return $this;
  }

  public function appendSwitch(SwitchInput $switch) {
    //$switch->setSize('small');
    $this->switches[] = $switch;
    return $this;
  }

  /**
   * 
   * @param string $name
   * @param scalar $inputValue
   * @param string $label
   * @return SwitchInput
   */
  public function appendNewSwitch(string $name = null, $inputValue = null, string $label = null): SwitchInput {
    $switch = SwitchInput::checkbox($name, $inputValue, $label);
    //$switch->s($label);
    $this->appendSwitch($switch);
    return $switch;
  }

  public function contentToString(): string {
    $options = new Div();
    $options->addCssClass('options');
    foreach ($this->switches as $switch) {
      $options->append($switch);
    }
    return $this->description . $this->toggler . '<hr>' . $options;
  }

}
