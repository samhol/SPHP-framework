<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Buttons;


/**
 * Implementation of an HTML input type="button" tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InputButton extends AbstractInputButton {

  /**
   * Constructor
   *
   * @param  mixed $content the content of the button tag
   */
  public function __construct($content = null) {
    parent::__construct('button', $content);
  }

}
