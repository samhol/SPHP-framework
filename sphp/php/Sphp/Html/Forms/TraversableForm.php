<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\TraversableContent;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Forms\Inputs\HiddenInputs;

/**
 * Defines required properties for a traversable HTML &lt;form&gt; component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TraversableForm extends Form, TraversableContent {

  /**
   * Appends a hidden variable into the form
   *
   * Appended `$name => $value` pair is stored into a
   *  {@link HiddenInput} object
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return HiddenInput appended input instance
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value): HiddenInput;

  /**
   * Returns all named input components in the form
   *
   * @return TraversableContent containing matching sub components
   */
  public function getNamedInputComponents(): TraversableContent;

  /**
   * Returns all named {@link HiddenInput} components from the form
   *
   * @return HiddenInputs containing matching sub components
   */
  public function getHiddenInputs(): HiddenInputs;
}
