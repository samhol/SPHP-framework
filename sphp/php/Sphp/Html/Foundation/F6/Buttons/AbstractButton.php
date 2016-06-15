<?php

/**
 * AbstractButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\AbstractContainerComponent as AbstractComponent;

/**
 * Class implements Foundation Button in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractButton extends AbstractComponent implements ButtonInterface {

	use ButtonTrait;

	/**
	 * Constructs a new instance
	 *
	 * @param string $tagName the name of the container tag
	 * @param null|mixed $content the content of the button
	 */
	public function __construct($tagName, $content = null) {
		parent::__construct($tagName);
		$this->cssClasses()->lock("button");
        if ($content !== null) {
          $this->content()->append($content);
        }
	}

}
