<?php

/**
 * CalloutInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\Div as Div;
use Sphp\Html\Foundation\F6\Buttons\CloseButton as CloseButton;
use Sphp\Html\Foundation\F6\Core\ColourableInterface as ColourableInterface;
use Sphp\Html\Foundation\F6\Core\ColourableTrait as ColourableTrait;

/**
 * Class implements a Foundation 6 callout component
 *
 * Callouts combine panels and alerts from Foundation 5 into one generic container component.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation 6 Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CalloutInterface extends ColourableInterface {

  /**
   * Sets/unsets the callout closable
   * 
   * Values for `$closable` parameter
   * 
   * * `true`: the callout is closable and the default closing effect is used 
   * * `'slide-out-right'`
   * * ...any other Foundation Motion UI effect string
   * * `false`: the callout is not closable
   * 
   * @param  string|boolean $closable true for closable and false otherwise
   * @return self for PHP Method Chaining
   */
  public function setClosable($closable = true);

  /**
   * Checks whether the callout is closable or not
   * 
   * @return boolean true if callout is closable and false if not
   */
  public function isClosable();
}
