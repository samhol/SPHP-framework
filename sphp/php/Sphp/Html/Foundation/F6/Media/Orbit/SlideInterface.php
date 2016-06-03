<?php

/**
 * SlideInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Lists\LiInterface as LiComponent;
use Sphp\Html\Foundation\Buttons\HyperlinkButton as HyperlinkButton;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Orbit slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SlideInterface extends LiComponent {

  /**
   * Generates a link component ponting to the OrbitSlide
   *
   * @param  mixed|mixed[] $content
   * @return HyperlinkButton slide link component
   */
  public function getSlideLink($content);
}
