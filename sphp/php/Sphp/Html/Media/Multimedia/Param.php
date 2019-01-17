<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;param&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Param extends EmptyTag {

  /**
   * Constructor
   *
   * @param  string $name the name of a parameter
   * @param  string $value the value of a parameter
   * @link   http://www.w3schools.com/tags/att_param_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_param_value.asp value attribute
   */
  public function __construct(string $name = null, string $value = null) {
    parent::__construct('param');
    if ($name !== null) {
      $this->setName($name);
    }
    if ($value !== null) {
      $this->setValue($value);
    }
  }

  /**
   * Sets the name of a parameter
   * 
   * @param  string $name the name of a parameter
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  /**
   * Sets the value of a parameter
   * 
   * @param  scalar $value the value of a parameter
   * @return $this for a fluent interface
   */
  public function setValue($value) {
    $this->attributes()->setAttribute('value', $value);
    return $this;
  }

  /**
   * Returns the language of the track text data
   * 
   * @return string the language of the track text data
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   * @link   http://www.w3schools.com/tags/ref_language_codes.asp HTML Language Code Reference
   */
  public function getName() {
    return $this->getAttribute('name');
  }

  /**
   * Returns the label of the track text data
   * 
   * @return string the label of the track text data
   * @link   http://www.w3schools.com/tags/att_track_label.asp label attribute
   */
  public function getValue() {
    return $this->getAttribute('value');
  }

}
