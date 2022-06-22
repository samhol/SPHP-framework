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

/**
 * Implements an abstract iframe based Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractVideoPlayer extends AbstractContent implements VideoPlayer {

  /**
   * the url of the player  
   */
  protected URL $url;
  private Iframe $iframe;

  /**
   * Constructor
   *
   * @param  URL $url the URL of the video
   */
  public function __construct(URL $url) {
    $this->url = $url;
    $this->iframe = new Iframe();
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
   * Returns a copy of the players URL
   * 
   * @return URL a copy of the players URL
   */
  public function createPlayerUrl(): URL {
    return clone $this->url;
  }

  /**
   * Setz the option name value pair
   * 
   * * These parameters are passed to the player as `url` query parameters
   * * A null value remover the parameter
   * * boolean values are casted to integers
   * 
   * @param  string $name the name of the parameter
   * @param  string|int|float|bool|null $value the value of the parameter
   * @return $this for a fluent interface 
   */
  public function setOption(string $name, string|int|float|bool|null $value) {
    if (is_null($value)) {
      $this->url->getQuery()->removeParameter($name);
    } else {
      if (is_bool($value)) {
        $value = (int) $value;
      }
      $this->url->getQuery()->setParameter($name, $value);
    }
    return $this;
  }

  /**
   * Sets or unsets the media source loading as lazy
   * 
   * @param  bool $lazy true for lazy loading, false otherwise
   * @return $this for a fluent interface
   */
  public function setLoading(?string $loading) {
    $this->iframe->setLoading($loading);
    return $this;
  }

  /**
   * Sets the width and the height of the component (in pixels)
   * 
   * @param  int|null $width the width of the component (in pixels))
   * @param  int|null $height the height of the component (in pixels)
   * @return $this for a fluent interface
   */
  public function setSize(?int $width = null, ?int $height = null) {
    $this->iframe->setSize($width, $height);
    return $this;
  }

  /**
   * Allows or disallows the full screen mode of the video 
   * 
   * @param  bool $allow
   * @return $this for a fluent interface
   */
  public function allowFullScreen(bool $allow = true) {
    $this->iframe->allowFullScreen($allow);
    return $this;
  }

  public function createIframe(): Iframe {
    $iframe = clone $this->iframe;
    $iframe->setSrc((string) $this->url);
    return $iframe;
  }

  public function getHtml(): string {
    return $this->createIframe()->getHtml();
  }

}
