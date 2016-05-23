<?php

/**
 * MouseCoordinateViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractJavaScriptComponent as AbstractJavaScriptComponent;

/**
 * Class MouseCoordinateViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-23
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MouseCoordinatesViewer extends AbstractJavaScriptComponent {

	/**
	 * Constructs a new instance
	 */
	public function __construct() {
		parent::__construct("div");
		$this->lockCssClass("sphp-nfo-icon sphp-MouseCoordinatesViewer")
				->identify("sphp-MouseCoordinatesViewer");
$this->scriptsContainer()->appendCode('$("#' . $this->getId() . '").sphMouseCoordinatesViewer();');
		$this->content()->append('<span class="fi-icon fi-paw font-size-36"></span>'
            . '<div class="coords">'
            . '<div><span>x:</span><span class="x">0</span><span>px</span></div>'
            . '<div><span>y:</span><span class="y">0</span><span>px</span></div>'
            . '</div>');
	}

}
