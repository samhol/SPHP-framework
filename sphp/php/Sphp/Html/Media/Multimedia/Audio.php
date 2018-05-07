<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

/**
 * Implements an HTML &lt;audio&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_audio.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Audio extends AbstractMultimediaTag {

  /**
   * Constructor
   *
   * @param  mixed $sources optional sources
   */
  public function __construct($sources = null) {
    parent::__construct('audio', null, $sources);
    //$this->showControls(true);
  }

  /**
   * Specifies how the audio file should be loaded when the page loads
   * 
   * **Note:** Note: The preload attribute is ignored if the audio is on autoplay
   * 
   * **Attribute Values:**
   * 
   * * `auto`: The browser should load the entire audio file when the page loads
   * * `metadata`: The browser should load only metadata when the page loads
   * * `none`: The browser should NOT load the audio file when the page loads
   * 
   * @param  string $preload the value of the preload attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_preload.asp preload attribute
   */
  public function setPreload($preload) {
    return $this->setAttribute('preload', $preload);
  }

  /**
   * Specifies how the audio file should be loaded when the page loads
   * 
   * **Note:** Note: The preload attribute is ignored if the audio is on autoplay
   * 
   * **Attribute Values:**
   * 
   * * `auto`: The browser should load the entire audio file when the page loads
   * * `metadata`: The browser should load only metadata when the page loads
   * * `none`: The browser should NOT load the audio file when the page loads
   * 
   * @return  string the value of the preload attribute
   * @link   http://www.w3schools.com/tags/att_audio_preload.asp preload attribute
   */
  public function getPreloadOption() {
    return $this->getAttribute('preload');
  }

}
