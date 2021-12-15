<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractContent;
use Sphp\Network\URL;
use Sphp\Html\Media\Multimedia\Iframe;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Implements an abstract iframe based Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractVideoPlayer extends AbstractContent implements VideoPlayer {

  /**
   * the url of the player
   *
   * @var URL 
   */
  private URL $url;
  private bool $lazy;
  private array $iframeAttributes;

  /**
   * Constructor
   *
   * @param  URL $url the URL of the video
   */
  public function __construct(URL $url) {
    $this->url = $url;
    $this->iframeAttributes = [];
    $this->lazy = false;
    $this->allowFullScreen(true);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->url);
  }

  public function __clone() {
    $this->url = clone $this->url;
  }

  /**
   * Returns the URL
   * 
   * @return URL players URL
   */
  protected function getUrl(): URL {
    return $this->url;
  }

  /**
   * Returns a copy of the players URL
   * 
   * @return URL a copy of the players URL
   */
  public function getUrlCopy(): URL {
    return clone $this->url;
  }

  /**
   * Setz the option name value pair
   * 
   * * These parameters are passed to the player as `url` query parameters
   * * A null value remover the parameter
   * 
   * @param  string $name the name of the parameter
   * @param  scalar|null $value the value of the parameter
   * @return $this for a fluent interface
   * @throws VideoPlayerException if the option name - value pair is invalid
   */
  public function setOption(string $name, $value) {
    if (!is_scalar($value) && !is_null($value)) {
      throw new VideoPlayerException("Invalid value provided for the $name option");
    }
    if (is_null($value)) {
      $this->url->getQuery()->removeParameter($name);
    } else {
      $this->url->getQuery()->setParameter($name, $value);
    }
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @param  scalar|null $value
   * @return $this for a fluent interface
   * @throws VideoPlayerException if the attribute name or value is invalid
   */
  public function setIframeAttribute(string $name, $value) {
    if (!is_scalar($value) && !is_null($value)) {
      throw new VideoPlayerException("Invalid value provided for the $name attribute");
    } if ($name === 'src') {
      throw new VideoPlayerException("Setting the src attribute is not allowed");
    }
    if (is_scalar($value)) {
      $this->iframeAttributes[$name] = $value;
    } else {
      unset($this->iframeAttributes[$name]);
    }
    return $this;
  }

  /**
   * Checks whether the media source loading is lazy
   * 
   * @return bool true for lazy loading, false otherwise
   */
  public function isLazy(): bool {
    return $this->lazy;
  }

  /**
   * Sets or unsets the media source loading as lazy
   * 
   * @param  bool $lazy true for lazy loading, false otherwise
   * @return $this for a fluent interface
   */
  public function setLazy(bool $lazy = true) {
    $this->lazy = $lazy;
    return $this;
  }

  /**
   * Sets the width and the height of the component (in pixels)
   * 
   * @param  int $width the width of the component (in pixels))
   * @param  int $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setSize(int $width = null, int $height = null) {
    $this->setIframeAttribute('width', $width);
    $this->setIframeAttribute('height', $height);
    return $this;
  }

  /**
   * Allows or disallows the full screen mode of the video 
   * 
   * @param  bool $allow
   * @return $this for a fluent interface
   */
  public function allowFullScreen(bool $allow = true) {
    $this->setIframeAttribute('allowfullscreen', $allow);
    return $this;
  }

  public function createIframe(): Iframe {
    if ($this->isLazy()) {
      $iframe = new LazyIframe((string) $this->getUrl());
    } else {
      $iframe = new Iframe((string) $this->getUrl());
    }
    $iframe->attributes()->merge($this->iframeAttributes);
    return $iframe;
  }

  public function getHtml(): string {
    return $this->createIframe()->getHtml();
  }

  public function displayControls(bool $visible = true) {
    $this->setOption('controls', (int) $visible);
    return $this;
  }

  public function autoplay(bool $autoplay = true) {
    $this->setOption('autoplay', (int) $autoplay);
    return $this;
  }

  public function mute(bool $mute = true) {
    $this->setOption('mute', (int) $mute);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->setOption('loop', (int) $loop);
    return $this;
  }

}
