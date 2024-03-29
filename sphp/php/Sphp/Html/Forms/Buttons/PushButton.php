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

/**
 * Implementation of an HTML button type="button" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PushButton extends AbstractButton {

  /**
   * Constructor
   *
   * @param  mixed $content the content of the button tag
   */
  public function __construct(mixed $content = null) {
    parent::__construct('button', 'button', $content);
  }

}
