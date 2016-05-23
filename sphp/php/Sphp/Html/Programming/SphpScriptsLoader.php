<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Programming;

/**
 * Description of SphpScriptsLoader
 *
 * @author samih_000
 */
class SphpScriptsLoader extends ScriptsContainer {

  /**
   * Appends Modernizr
   *
   * @return self for PHP Method Chaining
   * @link   http://modernizr.com/ Modernizr
   */
  public function appendModernizr() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "modernizr.js");
  }

  /**
   * Appends FastClick
   *
   * @return self for PHP Method Chaining
   * @link   https://github.com/ftlabs/fastclick FastClick
   */
  public function appendFastclick() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "fastclick.js");
  }

  /**
   * Appends the jQuery JavaScript file
   *
   * @return self for PHP Method Chaining
   * @link   http://jquery.com/ jQuery
   */
  public function appendJQuery() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.js");
  }

  /**
   * Appends JavaScript files for Foundation 6
   *
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/ Foundation
   */
  public function appendFoundation() {
    return $this->appendJQuery()
                    ->appendSrc("vendor/zurb/foundation/dist/foundation.min.js");
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
                    ->appendSrc(\Sphp\js\VENDOR_PATH . "anytime.c.js");
  }

  /**
   * Appends JavaScript files for Video.js
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendVideojs() {
    return $this
                    ->appendJQuery()
                    ->appendSrc(\Sphp\js\VENDOR_PATH . "anytime.c.js");
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
                    ->appendSrc(\Sphp\js\VENDOR_PATH . "ZeroClipboard.min.js");
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
                    ->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.lazyloadxt.extra.min.js");
  }

  /**
   * Appends JavaScript files for build-in Photoalbum
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendPhotoAlbum() {
    return $this->appendSrc(\Sphp\js\APP_PATH . "PhotoAlbum.js");
  }

  /**
   * Appends JavaScript files for build-in Photoalbum
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function appendIonRangeSlider() {
    return $this->appendJQuery()
            ->appendSrc(\Sphp\js\VENDOR_PATH . "ion.rangeSlider.min.js")
            ->appendSrc(\Sphp\js\APP_PATH . "init.ion.rangeSliders.js");
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
            ->appendPhotoAlbum()
            ->appendIonRangeSlider()
            ->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.qtip.min.js")
            ->appendSrc(\Sphp\js\APP_PATH . "commonJqueryPlugins.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.form.validation.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.SideNavs.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.TechLinks.js")
            ->appendSrc(\Sphp\js\SPH_ALL_PATH)
            ->appendCode('sphp.initialize("' . \Sphp\HTTP_ROOT . '");');
    return $this;
  }

}
