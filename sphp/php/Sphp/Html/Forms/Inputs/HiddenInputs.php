<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\AbstractContent;
use IteratorAggregate;
use Sphp\Html\Iterator;
use Traversable;
use Sphp\Html\Forms\FormController;
use Sphp\Stdlib\Arrays;

/**
 * Implements hidden data component for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HiddenInputs extends AbstractContent implements IteratorAggregate, \Sphp\Html\TraversableContent, FormController {

  /**
   * @var HiddenInput[]
   */
  private $inputs;

  /**
   * Constructor
   */
  public function __construct() {
    $this->inputs = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->inputs);
  }

  public function __clone() {
    $this->inputs = Arrays::copy($this->inputs);
  }

  public function getHtml(): string {
    return implode($this->inputs);
  }

  /**
   * Inserts a hidden variable
   *
   * @param  string $name the name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return HiddenInput inserted instance
   */
  public function insertVariable(string $name, $value): HiddenInput {
    $input = new HiddenInput($name, $value);
    return $this->insertHiddenInput($input);
  }

  /**
   * Inserts a hidden input object
   * 
   * @param  HiddenInput $input hidden input object
   * @return HiddenInput inserted instance
   */
  public function insertHiddenInput(HiddenInput $input): HiddenInput {
    $this->inputs[] = $input;
    return $input;
  }

  public function contains(string $name): bool {
    $contains = false;
    foreach ($this->inputs as $input) {
      if ($input->getName() === $name) {
        $contains = true;
        break;
      }
    }
    return $contains;
  }

  /**
   * Returns the value of the hidden variable
   *
   * @param  string $name the name of the hidden variable
   * @return HiddenInputs the value of the hidden variable or `null`
   */
  public function getByName(string $name): HiddenInputs {
    $result = new HiddenInputs();
    foreach ($this->inputs as $input) {
      if ($input->getName() === $name) {
        $result->insertHiddenInput($input);
      }
    }
    return $result;
  }

  public function getIterator(): Traversable {
    return new Iterator($this->inputs);
  }

  public function disable(bool $disabled = true) {
    foreach ($this->inputs as $input) {
      $input->disable($disabled);
    }
    return $this;
  }

  /**
   * Checks whether the controller is enabled or not
   * 
   * Important: This controller is disabled only if all of its inputs are disabled.
   * 
   * @return bool true if enabled, otherwise false
   */
  public function isEnabled(): bool {
    $enabled = false;
    foreach ($this->inputs as $input) {
      $enabled = $input->isEnabled();
      if ($enabled) {
        break;
      }
    }
    return $enabled;
  }

  public function count(): int {
    return count($this->inputs);
  }

  public function getComponentsBy(callable $rules): \Sphp\Html\TraversableContent {
    
  }

  public function getComponentsByObjectType($typeName): \Sphp\Html\TraversableContent {
    
  }

  public function toArray(): array {
    return $this->inputs;
  }

}
