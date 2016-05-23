<?php

/**
 * AbstractVideoPlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Util\Strings as Strings;
use Sphp\Net\URL as URL;

/**
 * Class models a Foundation Flex Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractVideoPlayer extends AbstractIframe {

  /**
   * the url of the player
   *
   * @var URL 
   */
  private $url;

  /**
   * the url of the player
   *
   * @var string 
   */
  private $videoId;

  /**
   * Constructs a new instance
   *
   * @param  string|URL $url the id of the Vimeo video
   * @param  string $videoId the id of the embedded video
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function __construct($url, $videoId = null) {
    parent::__construct();
    $this->setPlayerUrl($url)->allowFullScreen(true);
    if (Strings::notEmpty($videoId)) {
      $this->setVideoId($videoId);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    parent::__destruct();
    unset($this->url, $this->videoId);
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    parent::__clone();
    $this->url = clone $this->url;
    $this->setPlayerUrl($this->url);
  }

  /**
   * Sets the URL of the video service/player
   * 
   * @param  string|URL $url the URL of the video service/player
   * @return self for PHP Method Chaining
   */
  protected function setPlayerUrl($url) {
    $this->url = ($url instanceof URL) ? $url : new Url($url);
    $this->setAttr("src", $this->url);
    return $this;
  }

  /**
   * Sets the id of the viewed video stream
   * 
   * @param  string $videoId the id of the embedded video
   * @return self for PHP Method Chaining
   */
  public function setVideoId($videoId) {
    $this->videoId = $videoId;
    $this->url->setPath($this->url->getPath() . $videoId);
    $this->setAttr("src", $this->url);
    return $this;
  }

  /**
   * Allows or disallows the fullscreen mode of the video 
   * 
   * @param  boolean $allow
   * @return self for PHP Method Chaining
   */
  public function allowFullScreen($allow = true) {
    $this->setAttr("webkitallowfullscreen", $allow)
            ->setAttr("mozallowfullscreen", $allow)
            ->setAttr("allowfullscreen", $allow);
    return $this;
  }

  /**
   * Set autoplaying on or off
   * 
   * @param  boolean $autoplay true for on and false for off
   * @return self for PHP Method Chaining
   */
  public function autoplay($autoplay = true) {
    return $this->setParam("autoplay", (int) $autoplay);
  }

  /**
   * Setx the looping on or off
   * 
   * @param  boolean $loop true for on and false for off
   * @return self for PHP Method Chaining
   */
  public function loop($loop = true) {
    return $this->setParam("loop", (int) $loop);
  }

  /**
   * Setz the parameter name value pair
   * 
   * Parameters:
   * 
   * * **autoplay:**
   *   * `0` (default): The video will not play automatically when the player loads.
   *   * `1`: The video will play automatically when the player loads.
   * * **controls:**
   *   * `0`: Player controls does not display. The video loads immediately.
   *   * `1` (default): Player controls display. The video loads immediately.
   *   * `2`: Player controls display, but the video does not load before the user initiates playback. 
   * * **loop:**
   *   * `0` (default): The video will play only once.
   *   * `1`: The video will loop (forever).
   * 
   * @param  string $name the name of the parameter
   * @param  scalar $value the value of the parameter
   * @return self for PHP Method Chaining
   */
  public function setParam($name, $value) {
    $this->url->setParam($name, $value);
    return $this;
  }

}
