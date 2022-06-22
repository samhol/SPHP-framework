<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\Forms\Inputs\AbstractInputTag;
use Sphp\Html\Forms\Buttons\Button;

/**
 * Implementation of an HTML push button type="button" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InputButton extends AbstractInputTag implements Button {

  /**
   * Constructor
   *
   * @param mixed $content the value of value attribute
   */
  public function __construct(mixed $content = null) {
    parent::__construct('button', null, $content);
  }

}
