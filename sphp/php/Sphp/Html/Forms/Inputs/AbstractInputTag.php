<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\EmptyTag;

/**
 * Class is the abstract base class for all &lt;input&gt; tag implementations
 *
 * This component specifies an HTML input field 
 * where the user can enter data. These components are used within a 
 * {@link \Sphp\Html\Forms\FormInterface} component to declare input controls 
 * that allow users to input data. 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractInputTag extends EmptyTag implements Input {

  use InputTagTrait;

  /**
   * Constructor
   *
   * @param  string|null $type the value of the type attribute
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $type = null, string $name = null, $value = null) {
    parent::__construct('input');
    $this->attributes()->protect('type', $type);
    $this->setName($name);
    $this->setInitialValue($value);
  }

}
