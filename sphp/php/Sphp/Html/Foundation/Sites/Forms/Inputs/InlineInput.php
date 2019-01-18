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
use Sphp\Html\Forms\Inputs\IdentifiableInput;

/**
 * Class InputGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InlineInput extends AbstractComponent implements IdentifiableInput {

  use \Sphp\Html\Forms\Inputs\InputWrapperTrait;

  /**
   * @var string|null
   */
  private $prefix;

  /**
   * @var string|null
   */
  private $suffix;

  /**
   * @var IdentifiableInput 
   */
  private $input;

  /**
   * Constructor
   * 
   * @param IdentifiableInput $input
   * @param string|null $prefix the content of the prefix
   * @param string|null $suffix the content of the suffix
   */
  public function __construct(IdentifiableInput $input, $prefix = null, $suffix = null) {
    parent::__construct('div');
    $this->cssClasses()->protectValue('input-group');
    $this->prefix = $prefix;
    $this->input = $input;
    $this->suffix = $suffix;
    $this->input->cssClasses()->protectValue('input-group-field');
  }

  /**
   * 
   * 
   * @return IdentifiableInput
   */
  public function getInput() {
    return $this->input;
  }

  /**
   * Sets the content of the prefix
   * 
   * `null` value hides the prefix
   * 
   * @param  string|null $prefix the content of the prefix
   * @return $this for a fluent interface
   */
  public function setPrefix($prefix = null) {
    $this->prefix = $prefix;
    return $this;
  }

  /**
   * Sets the content of the suffix
   * 
   * `null` value hides the suffix
   * 
   * @param  string|null $suffix the content of the suffix
   * @return $this for a fluent interface
   */
  public function setSuffix($suffix = null) {
    $this->suffix = $suffix;
    return $this;
  }

  public function contentToString(): string {
    $a = function ($v) {
      if ($v !== null) {
        return '<span class="input-group-label">' . $v . '</span>';
      } else {
        return "";
      }
    };
    return $a($this->prefix) . $this->input->getHtml() . $a($this->suffix);
  }

  public function getSubmitValue() {
    $this->getInput()->getSubmitValue();
  }

}
