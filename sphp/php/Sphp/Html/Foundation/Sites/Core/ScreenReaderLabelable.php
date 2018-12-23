<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Implements Screen reader label for Foundation
 * 
 * As default all of the content of this component is only visible for screen readers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/visibility.html#show-for-screen-readers-only Foundation screen readers
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface ScreenReaderLabelable {

  /**
   * Sets the inner label for screen reader text
   * 
   * @param  string $label the screen reader label or its textual content
   * @return $this for a fluent interface
   */
  public function setScreenReaderLabel(string $label = null);
}
