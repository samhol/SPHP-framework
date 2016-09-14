<?php

/**
 * Source.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\EmptyTag as EmptyTag;
use Sphp\Html\Media\LazyLoaderInterface as LazyLoaderInterface;
use Sphp\Html\Media\LazyLoaderTrait as LazyLoaderTrait;
use Sphp\Net\URL as URL;
use Sphp\Core\Util\FileUtils as FileUtils;

/**
 * Class Models an HTML &lt;source&gt; tag
 *
 *  This component specifies media resources for {@link AbstractMediaTag} components.
 *
 *  This component allows you to specify alternative video/audio files which 
 *   the browser may choose from, based on its media type or codec support.
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-14
 * @link    http://www.w3schools.com/tags/tag_source.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-source-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Source extends EmptyTag implements MultimediaContentInterface, LazyLoaderInterface {

	use LazyLoaderTrait;

	/**
	 * Constructs a new instance
	 *
	 * @param  string|URL $src the URL of the media file
	 * @param  string $type the media type of the media resource
	 * @param  boolean $lazy true for lazy loading and false otherwise (default is true)
	 * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
	 * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
	 */
	public function __construct($src = false, $type = false, $lazy = false) {
		parent::__construct("source");
		$this
				->setSrc($src)
				->setType($type)
				->setLazy($lazy);
		if ($src && !$type) {
			$this->setType(FileUtils::getMimeType($src));
		}
	}

	/**
	 * Sets the media type of the media resource
	 *
	 * @param  string $type the media type of the media resource
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
	 */
	public function setType($type) {
		return $this->setAttr("type", $type);
	}

	/**
	 * Returns the media type of the media resource
	 *
	 * @return string the media type of the media resource
	 * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
	 */
	public function getType() {
		return $this->getAttr("type");
	}

}