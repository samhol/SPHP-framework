<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a factory for Font Awesome icon objects
 *
 * @method \Sphp\Html\Media\Icons\IconTag i(string $iconName) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag span(string $iconName) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class IconFactory extends AbstractIconFactory {

  public function createIcon(string $iconName, string $tagname = 'i'): IconTag {
    $icon = new IconTag($iconName, $tagname);
    $this->insertIconAttributesTo($icon);
    return $icon;
  }

}
