<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use Sphp\Network\URL;

/**
 * Implements an abstract iframe based Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractVideoPlayer extends AbstractComponent implements VideoPlayer {

  use \Sphp\Html\Media\SizeableMediaTrait,
      \Sphp\Html\Media\LazyMediaSourceTrait;

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
   * Constructor
   *
   * @param  string|URL $url the URL of the video
   * @param  string $videoId the id of the embedded video
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function __construct($url, string $videoId = null) {
    parent::__construct('iframe');
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
   * @return $this for a fluent interface
   */
  protected function setUrl($url) {
    $this->url = ($url instanceof URL) ? $url : new URL($url);
    $this->setAttribute('src', $this->url->getHtml());
    return $this;
  }

  /**
   * Sets the id of the viewed video stream
   * 
   * @param  string $videoId the id of the embedded video
   * @return $this for a fluent interface
   */
  public function setVideoId($videoId) {
    $this->videoId = $videoId;
    $this->url->setPart(PHP_URL_PATH, $this->url->getPath() . $videoId);
    $this->setAttribute('src', $this->url->getHtml());
    return $this;
  }

  public function allowFullScreen(bool $allow = true) {
    $this->attributes()
            //->set('webkitallowfullscreen', $allow)
            //->set('mozallowfullscreen', $allow)
            ->setAttribute('allowfullscreen', $allow);
    return $this;
  }

  public function autoplay(bool $autoplay = true) {
    $this->url->getQuery()->offsetSet('autoplay', (int) $autoplay);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->url->getQuery()->offsetSet('loop', (int) $loop);
    return $this;
  }

  /**
   * Unsetz the given parameter
   * 
   * These parameters are passed to the player as `url` query parameters
   * 
   * @param  string $name the name of the parameter to unset
   * @return $this for a fluent interface
   */
  public function unsetParam($name) {
    //$this->url->getPath();
    $this->url->getQuery()->offsetUnset($name);
    return $this;
  }

  /**
   * Setz the parameter name value pair
   * 
   * These parameters are passed to the player as `url` query parameters
   * 
   * @param  string $name the name of the parameter
   * @param  scalar $value the value of the parameter
   * @return $this for a fluent interface
   */
  public function setParam(string $name, $value) {
    $this->url->getQuery()->offsetSet($name, $value);
    return $this;
  }

  public function contentToString(): string {
    return '';
  }

  /**
   * Sets the title of the iframe
   *
   * @param  string $title the title of the iframe
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle(string $title = null) {
    $this->attributes()->setAttribute('title', $title);
    return $this;
  }

}
