<?php

/**
 * Slide.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Lists\LiInterface as LiComponent;
use Sphp\Html\Div as Div;
use Sphp\Html\Foundation\Buttons\HyperlinkButton as HyperlinkButton;
use Sphp\Util\Strings as Strings;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Orbit slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated since version 2.0.0
 */
class Slide extends AbstractComponent implements LiComponent {

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
	 * @param  mixed|mixed[] $caption the caption of the slide
	 * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
	 */
	public function __construct($content = null, $caption = null) {
		parent::__construct(LiComponent::TAG_NAME);
		$this->cssClasses()->lock("orbit-slide");
		$this->content()->set("content", (new Div($content))->setStyle("background", "#fff")->addCssClass("alert"));
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

	/**
	 * Returns the content component
	 *
	 * @return Div
	 */
	protected function getContent() {
		return $this->content()->get("content");
	}

	/**
	 * Returns the caption component
	 *
	 * @return Div
	 */
	protected function getCaption() {
		return $this->content()->get("caption");
	}

	/**
	 * Set the content of the slide
	 *
	 * **Important!**
	 *
	 * Parameter <var>mixed $content</var> can be of any type
	 * that converts to a string. So also an object of any class that implements
	 * magic method `__toString()` is allowed.
	 *
	 * @param  mixed|mixed[] $content the content of the slide
	 * @return self for PHP Method Chaining
	 */
	public function setContent($content) {
		$this->getContent()->replaceContent($content);
		//$this->replaceContent(array($this->content, $this->caption));
		return $this;
	}

	/**
	 * Set the caption of the slide
	 *
	 * **Important!**
	 *
	 * Parameter <var>mixed $caption</var> can be of any type
	 * that converts to a string. So also an object of any class that implements
	 * magic method `__toString()` is allowed.
	 *
	 * @param  mixed|mixed[] $caption the content of the slide
	 * @return self for PHP Method Chaining
	 */
	public function setCaption($caption) {
		$this->getCaption()->replaceContent($caption);
		if (Strings::isEmpty($caption)) {
			$this->getCaption()->hide();
		} else {
			$this->getCaption()->unhide();
		}
		//$this->replaceContent(array($this->content, $this->caption));
		return $this;
	}

}
