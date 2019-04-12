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
   * Returns all named input components in the form
   *
   * @return TraversableContent containing matching sub components
   */
  public function getNamedInputComponents(): TraversableContent;
}
