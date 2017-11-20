<?php

/**
 * SphpScriptsLoader.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

/**
 * Implements a SPHP JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SphpScriptsLoader extends ScriptsContainer {

  /**
   * Folder paths to script resources
   *
   * @var string[]
   */
  private $paths;

  public function __construct($scripts = null) {
    parent::__construct($scripts);
    $this->paths['vendor'] = 'sphp/js/vendor/';
    $this->paths['app'] = 'sphp/js/app/';
    $this->paths['js_root'] = 'sphp/js/';
  }

  /**
   * Appends Modernizr
   *
   * @return $this for a fluent interface
   * @link   http://modernizr.com/ Modernizr
   */
  public function appendModernizr() {
    return $this->appendSrc($this->paths['vendor'] . 'modernizr.js');
  }

  /**
   * Appends FastClick
   *
   * @return $this for a fluent interface
   * @link   https://github.com/ftlabs/fastclick FastClick
   */
  public function appendFastclick() {
    return $this->appendSrc($this->paths['vendor'] . 'fastclick.js');
  }

  /**
   * Appends the jQuery JavaScript file
   *
   * @return $this for a fluent interface
   * @link   http://jquery.com/ jQuery
   */
  public function appendJQuery() {
    return $this->appendSrc($this->paths['vendor'] . 'jquery.js');
  }

  /**
   * Appends JavaScript files for Foundation 6
   *
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/ Foundation
   */
  public function appendFoundation() {
    return $this->appendJQuery()
                    ->appendSrc('vendor/zurb/foundation/dist/js/foundation.min.js');
  }

  /**
   * Appends JavaScript files for Any+Time AJAX Calendar Widget
   *
   * @return $this for a fluent interface
   * @link   http://www.ama3.com/anytime/ Any+Time
   */
  public function appendAnyTime() {
    $this->appendJQuery()
            ->appendSrc($this->paths['vendor'] . 'anytime.c.js');
    return $this;
  }

  /**
   * Appends JavaScript files for Video.js
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendVideojs() {
    $this->appendSrc('http://vjs.zencdn.net/6.4.0/video.js');
    return $this;
  }

  /**
   * Appends JavaScript files for Lazy Load XT
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendLazyload() {
    $this->appendJQuery()
            ->appendSrc($this->paths['vendor'] . 'jquery.lazyloadxt.extra.min.js');
    return $this;
  }

  /**
   * Appends JavaScript files for build-in Photoalbum
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendPhotoAlbum() {
    $this->appendSrc($this->paths['app'] . 'PhotoAlbum.js');
    return $this;
  }

  /**
   * Appends JavaScript files for ION range slider
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendIonRangeSlider() {
    $this->appendJQuery()
            ->appendSrc($this->paths['vendor'] . 'ion.rangeSlider.min.js')
            ->appendSrc($this->paths['app'] . 'init.ion.rangeSliders.js');
    return $this;
  }

  /**
   * Appends JavaScript files for `clipboard.js` to copy text to clipboard
   *
   * @return $this for a fluent interface
   * @link   https://clipboardjs.com/ clipboard.js
   */
  public function appendClipboard() {
    $this->appendSrc($this->paths['vendor'] . 'clipboard.js');
    return $this;
  }

  /**
   * Appends JavaScript files for the entire SPHP framework
   *
   * @return $this for a fluent interface
   */
  public function appendSPHP() {
    $this
            ->appendSrc($this->paths['js_root'] . "dist/all.js")
            ->appendCode('sphp.initialize();');
    $this->appendVideojs();
    return $this;
  }

  /**
   * Appends JavaScript files for the entire SPHP framework
   *
   * @return $this for a fluent interface
   */
  public function appendSPHP1() {
    $this->appendFoundation()
            ->appendLazyload()
            ->appendClipboard()
            ->appendAnyTime()
            ->appendVideojs()
            ->appendIonRangeSlider()
            ->appendSrc($this->paths['vendor'] . 'jquery.qtip.min.js')
            ->appendSrc($this->paths['app'] . 'commonJqueryPlugins.js')
            ->appendSrc($this->paths['app'] . 'QtipAdapter.js')
            ->appendSrc($this->paths['app'] . 'sphp.TechLinks.js')
            ->appendSrc($this->paths['js_root'] . "sphp.all.js")
            ->appendCode('sphp.initialize();')
            ->appendSrc($this->paths['app'] . 'sphp.ProgressBar.js');
    return $this;
  }

}
