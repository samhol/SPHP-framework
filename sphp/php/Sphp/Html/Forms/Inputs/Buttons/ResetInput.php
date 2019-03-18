<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Buttons;

use Sphp\Html\Forms\Buttons\ResetterInterface;

/**
 * Implements an HTML &lt;input type="reset"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ResetInput extends AbstractInputButton implements ResetterInterface {

  /**
   * Constructor
   *
   * @param  string|null $content the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $content = null) {
    parent::__construct('reset', $content);
  }

}
