<?php

/**
 * FlexVideo.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\AbstractSimpleContainerTag as AbstractSimpleContainerTag;
use Sphp\Html\Media\LazyLoaderInterface as LazyLoaderInterface;
use Sphp\Html\Media\AbstractVideoPlayer as AbstractVideoPlayer;
use Sphp\Html\Media\VimeoPlayer as VimeoPlayer;
use Sphp\Html\Media\YoutubePlayer as YoutubePlayer;

/**
 * Class models a Foundation 6 Flex Video component
 *
 * Flex Video lets browsers automatically scale video objects in webpages. If a 
 * video is embedded from YouTube, Vimeo, or another site that uses iframe, 
 * embed or object elements, video can be wrap into {@link self} to create 
 * an intrinsic ratio that will properly scale the video on any device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/flex_video.html Flex Video
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FlexVideo extends AbstractSimpleContainerTag implements LazyLoaderInterface {

	/**
	 * Youtube Video provider
	 */
	const YOUTUBE = 1;

	/**
	 * Vimeo Video provider
	 */
	const VIMEO = 2;

	/**
	 * Constructs a new instance
	 *
	 * @param  string|int $videoId the id of the provided video
	 * @param  int $provider the provider of the embedded video
	 */
	public function __construct($videoId = null, $provider = self::YOUTUBE) {
		parent::__construct("div");
		$this->cssClasses()->lock("flex-video");
		if (isset($videoId, $provider)) {
			$this->setSource($videoId, $provider);
		}
	}

	/**
	 * Sets the actual video player component
	 * 
	 * @param  AbstractVideoPlayer $player video player component
	 * @return self for PHP Method Chaining
	 */
	public function setPlayer(AbstractVideoPlayer $player) {
		$this->setContent($player);
		return $this;
	}

	/**
	 * Returns the actual video player component
	 * 
	 * @return AbstractVideoPlayer the actual video player component
	 */
	public function getPlayer() {
		return $this->getContent();
	}

	/**
	 * Sets the embedded video source
	 * 
	 * @param  string|int $videoId the id of the provided video
	 * @param  int $provider the provider of the embedded video
	 * @return self for PHP Method Chaining
	 */
	public function setSource($videoId, $provider = self::YOUTUBE) {
		if ($provider == self::YOUTUBE) {
			$this->setPlayer(new YoutubePlayer($videoId));
		} else if ($provider == self::VIMEO) {
			$this->setPlayer(new VimeoPlayer($videoId));
		}
		return $this;
	}

	/**
	 * Sets/unsets the widescreen property
	 * 
	 * @param  boolean $widescreen true for widescreen
	 * @return self for PHP Method Chaining
	 */
	public function setWidescreen($widescreen = true) {
		if ($widescreen) {
			$this->addCssClass("widesreen");
		} else if ($this->hasCssClass("widesreen")) {
			$this->removeCssClass("widesreen");
		}
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isLazy() {
		return $this->getPlayer()->isLazy();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setLazy($lazy = true) {
		$this->getPlayer()->setLazy($lazy);
		return $this;	
	}

}
