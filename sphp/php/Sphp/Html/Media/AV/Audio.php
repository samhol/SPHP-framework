<?php

/**
 * Audio.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

/**
 * Implements an HTML &lt;audio&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-07-20
 * @link    http://www.w3schools.com/tags/tag_audio.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Audio extends AbstractMediaTag {

  /**
   * Constructs a new instance
   *
   * @param  mixed|mixed[] $sources defines the audio sources
   */
  public function __construct($sources = null) {
    parent::__construct('audio', $sources);
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_audio_preload.asp preload attribute
   */
  public function setPreload($preload) {
    return $this->setAttr('preload', $preload);
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
    return $this->getAttr('preload');
  }

}
