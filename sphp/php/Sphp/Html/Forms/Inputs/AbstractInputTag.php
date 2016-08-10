<?php

/**
 * AbstractInputTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\EmptyTag as EmptyTag;
use Sphp\Html\Forms\Inputs\InputInterface as InputInterface;
use Sphp\Html\Forms\Inputs\InputTrait as InputTrait;

/**
 * Class is the abstract base class for all &lt;input&gt; tag implementations
 *
 * Definition and Usage The {@link self} component specifies an HTML input field 
 * where the user can enter data. {@link self} elements are used within a 
 * {@link \Sphp\Html\Forms\FormInterface} component to declare input controls 
 * that allow users to input data. 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-08-17
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractInputTag extends EmptyTag implements IdentifiableInputInterface {

  use InputTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of the type attribute
   * @param  string|null $name the value of the name attribute
   * @param  string|null $value the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($type, $name = null, $value = null) {
    parent::__construct("input");
    $this->attrs()->lock("type", $type);
    if (isset($name)) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setValue($value);
    }
  }

  /**
   * Returns the type attribute value
   *
   * @return string the type attribute value
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   */
  public function getType() {
    return $this->getAttr("type");
  }

  /**
   * Returns the value of the value attribute.
   *
   * @return string the value of the value attribute
   */
  public function getValue() {
    return $this->getAttr("value");
  }

  /**
   * Sets the value of the value attribute.
   *
   * @param  string $value the value of the value attribute
   * @param  int $filter The ID of the filter to apply. {@link http://php.net/manual/en/filter.filters.php list of the available filters}.
   * @return self for PHP Method Chaining
   */
  public function setValue($value, $filter = \FILTER_SANITIZE_FULL_SPECIAL_CHARS) {
    return $this->setAttr("value", filter_var($value, $filter));
  }

}
