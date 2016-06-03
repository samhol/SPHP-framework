<?php

/**
 * AbstractSlide.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Div as Div;
use Sphp\Html\Foundation\Buttons\HyperlinkButton as HyperlinkButton;
use Sphp\Core\Types\Strings as Strings;

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
abstract class AbstractSlide extends AbstractComponent implements SlideInterface {

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter <var>mixed $content</var> & <var>mixed $caption</var> can be of
   * any type that converts to a string. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @param  mixed|mixed[] $content the content of the slide
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct(self::TAG_NAME);
    $this->cssClasses()->lock("orbit-slide");
    if ($content !== null) {
      $this->setContent($content);
    }

    //$this->content()->set("content", (new Div($content))->setStyle("background", "#fff")->addCssClass("alert"));
    //$this->generateSlideId()->setCaption($caption);
  }

  /**
   * Generates a link component ponting to the OrbitSlide
   *
   * @param  mixed|mixed[] $content
   * @return HyperlinkButton slide link component
   */
  public function getSlideLink($content) {
    return (new HyperlinkButton())
                    ->setContent($content)
                    ->setAttr("data-orbit-link", $this->getSlideId());
  }

}
