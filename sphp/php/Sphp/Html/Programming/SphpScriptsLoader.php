<?php

/**
 * SphpScriptsLoader.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Core\Path;

/**
 * Description of SphpScriptsLoader
 *
 * 
 * **IMPORTANT:** 
 * 
 * The {@link self} component points to an external script file through the src attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-17
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SphpScriptsLoader extends ScriptsContainer {

  /**
   * Folderpaths to script resources
   *
   * @var string[]
   */
  private $paths;

  public function __construct($scripts = null) {
    parent::__construct($scripts);
    $router = Path::get();
    $this->paths['vendor'] = $router->http('sphp/js/vendor/');
    $this->paths['app'] = $router->http('sphp/js/app/');
    $this->paths['js_root'] = $router->http('sphp/js/');
  }

  /**
   * Appends Modernizr
   *
   * @return self for PHP Method Chaining
   * @link   http://modernizr.com/ Modernizr
   */
  public function appendModernizr() {
    return $this->appendSrc($this->paths['vendor'] . 'modernizr.js');
  }

  /**
   * Appends FastClick
   *
   * @return self for PHP Method Chaining
   * @link   https://github.com/ftlabs/fastclick FastClick
   */
  public function appendFastclick() {
    return $this->appendSrc($this->paths['vendor'] . 'fastclick.js');
  }

  /**
   * Appends the jQuery JavaScript file
   *
   * @return self for PHP Method Chaining
   * @link   http://jquery.com/ jQuery
   */
  public function appendJQuery() {
    return $this->appendSrc($this->paths['vendor'] . 'jquery.js');
  }

  /**
   * Appends JavaScript files for Foundation 6
   *
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/ Foundation
   */
  public function appendFoundation() {
    return $this->appendJQuery()
                    ->appendSrc('vendor/zurb/foundation/dist/js/foundation.min.js');
  }

  /**
   * Appends JavaScript files for Any+Time AJAX Calendar Widget
   *
   * @return self for PHP Method Chaining
   * @link   http://www.ama3.com/anytime/ Any+Time
   */
  public function appendAnyTime() {
    return $this
                    ->appendJQuery()
                    ->appendSrc($this->paths['vendor'] . 'anytime.c.js');
  }

  /**
   * Appends JavaScript files for Video.js
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendVideojs() {
    return $this->appendSrc('http://vjs.zencdn.net/5.11.6/video.js');
  }

  /**
   * Appends JavaScript files for ZeroClipboard
   *
   * @return self for PHP Method Chaining
   * @link   http://zeroclipboard.org/ ZeroClipboard
   */
  public function appendZeroClipboard() {
    return $this
                    ->appendJQuery()
                    ->appendSrc($this->paths['vendor'] . 'ZeroClipboard.min.js');
  }

  /**
   * Appends JavaScript files for Lazy Load XT
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendLazyload() {
    return $this
                    ->appendJQuery()
                    ->appendSrc($this->paths['vendor'] . 'jquery.lazyloadxt.extra.min.js');
  }

  /**
   * Appends JavaScript files for build-in Photoalbum
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendPhotoAlbum() {
    return $this->appendSrc($this->paths['app'] . 'PhotoAlbum.js');
  }

  /**
   * Appends JavaScript files for build-in Photoalbum
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendIonRangeSlider() {
    return $this->appendJQuery()
                    ->appendSrc($this->paths['vendor'] . 'ion.rangeSlider.min.js')
                    ->appendSrc($this->paths['app'] . 'init.ion.rangeSliders.js');
  }

  /**
   * Appends JavaScript files for the entire SPHP framework
   *
   * @return self for PHP Method Chaining
   */
  public function appendSPHP() {
    $this->appendFoundation()
            ->appendLazyload()
            ->appendZeroClipboard()
            ->appendAnyTime()
            ->appendVideojs()
            // ->appendPhotoAlbum()
            ->appendIonRangeSlider()
            ->appendSrc($this->paths['vendor'] . 'jquery.qtip.min.js')
            ->appendSrc($this->paths['app'] . 'commonJqueryPlugins.js')
            ->appendSrc($this->paths['app'] . 'sphp.form.validation.js')
            ->appendSrc($this->paths['app'] . 'sphp.SideNavs.js')
            ->appendSrc($this->paths['app'] . 'sphp.TechLinks.js')
            ->appendSrc($this->paths['js_root'] . "sphp.all.js")
            ->appendCode('sphp.initialize("' . Path::get()->http() . '");')
            ->appendSrc($this->paths['app'] . 'sphp.ProgressBar.js');
    return $this;
  }

}
