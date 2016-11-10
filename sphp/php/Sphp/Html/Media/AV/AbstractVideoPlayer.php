<?php

/**
 * AbstractVideoPlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\SizeableTrait;
use Sphp\Html\Media\LazyLoaderTrait;
use Sphp\Core\Types\URL;

/**
 * Class models a Foundation Flex Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractVideoPlayer extends AbstractComponent implements VideoPlayerInterface {

  use SizeableTrait,
      LazyLoaderTrait;

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
    parent::__construct("iframe");
    $this->setUrl($url)->allowFullScreen(true);
    if ($videoId !== null) {
      $this->setVideoId($videoId);
    }
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->url, $this->videoId);
  }

  public function __clone() {
    parent::__clone();
    $this->url = clone $this->url;
    $this->setPlayerUrl($this->url);
  }

  /**
   * 
   * @return URL
   */
  protected function getUrl() {
    return $this->url;
  }

  /**
   * Sets the URL of the video service/player
   * 
   * @param  string|URL $url the URL of the video service/player
   * @return self for PHP Method Chaining
   */
  protected function setUrl($url) {
    $this->url = ($url instanceof URL) ? $url : new URL($url);
    $this->setAttr("src", $this->url->getHtml());
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
    $this->setAttr("src", $this->url->getHtml());
    return $this;
  }

  public function allowFullScreen($allow = true) {
    $this->attrs()
            ->set("webkitallowfullscreen", $allow)
            ->set("mozallowfullscreen", $allow)
            ->set("allowfullscreen", $allow);
    return $this;
  }

  public function autoplay($autoplay = true) {
    $this->getUrl()->setParam("autoplay", (int) $autoplay);
    return $this;
  }

  public function loop($loop = true) {
    return $this->setParam("loop", (int) $loop);
  }

  /**
   * Unsetz the given parameter
   * 
   * These parameters are passed to the player as `url` query parameters
   * 
   * @param  string $name the name of the parameter to unset
   * @return self for PHP Method Chaining
   */
  public function unsetParam($name) {
    $this->url->getPath();
    $this->url->unsetParam($name);
    return $this;
  }

  /**
   * Setz the parameter name value pair
   * 
   * These parameters are passed to the player as `url` query parameters
   * 
   * @param  string $name the name of the parameter
   * @param  scalar $value the value of the parameter
   * @return self for PHP Method Chaining
   */
  public function setParam($name, $value) {
    $this->url->setParam($name, $value);
    return $this;
  }

  public function contentToString() {
    return "<p>Your browser does not support iframes.</p>";
  }

}
