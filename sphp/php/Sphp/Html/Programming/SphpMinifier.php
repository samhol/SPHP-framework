<?php

/**
 * Scripts.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContentInterface;
use Sphp\Html\Container;
use Sphp\Core\Types\BitMask as BitMask;
use Sphp\Data\StablePriorityQueue as StablePriorityQueue;

/**
 * Class is a container for a {@link Meta} component group
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-29
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SphpMinifier extends Minifier {

  /**
   * Sets up the Modernizr related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://modernizr.com/ Modernizr
   */
  public function useModernizr() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "modernizr.js");
  }

  /**
   * Sets up the Any+Time AJAX Calendar Widget related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.ama3.com/anytime/ Any+Time
   */
  public function useFastclick() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "fastclick.js");
  }

  /**
   * Sets up the Any+Time AJAX Calendar Widget related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.ama3.com/anytime/ Any+Time
   */
  public function useJQuery() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.js");
  }

  /**
   * Sets up the Foundation related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/ Foundation
   */
  public function useFoundation() {
    return $this->useModernizr()
                    ->useJQuery()
                    ->useFastclick()
                    ->appendSrc(\Sphp\js\VENDOR_PATH . "foundation.all.min.js");
    /* ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.alert.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.abide.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.accordion.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.clearing.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.dropdown.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.equalizer.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.interchange.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.joyride.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.magellan.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.offcanvas.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.orbit.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.reveal.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.slider.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.tab.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.tooltip.js")
      ->addScriptSrc(\Sphp\js\FOUNDATION_FOLDER . "foundation.topbar.js"); */
  }

  /**
   * Sets up the Any+Time AJAX Calendar Widget related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.ama3.com/anytime/ Any+Time
   */
  public function useAnyTime() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "anytime.c.js");
  }

  /**
   * Sets up the Video.js related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function useVideojs() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "anytime.c.js");
  }

  /**
   * Sets up the Video.js related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function useLazyload() {
    return $this->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.lazyloadxt.extra.min.js");
  }

  /**
   * Sets up the Video.js related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   * @link   http://www.videojs.com/ Video.js
   */
  public function usePhotoAlbum() {
    return $this->appendSrc(\Sphp\js\APP_PATH . "PhotoAlbum.js");
  }

  /**
   * Sets up the Foundation framework related Javascript and CSS files
   *
   * @return self for PHP Method Chaining
   */
  public function enableSPHP() {
    $this
            //->addCssSrc(\Sphp\HTTP_ROOT . "sph/css/normalize.css")
            //->addCssSrc("sph/css/ion.rangeSlider.css")
            //->addCssSrc("sph/css/ion.rangeSlider.skinNice.css")
            //->addCssSrc("sph/css/jquery.qtip.min.css")
            //->addCssSrc(\Sphp\HTTP_ROOT . "sph/css/foundation.css")
            //->addCssSrc(\Sphp\HTTP_ROOT . "sph/css/ui-lightness/jquery-ui.css")
            ->useModernizr()
            ->useFoundation()
            ->appendSrc(\Sphp\js\VENDOR_PATH . "ZeroClipboard.min.js")
            ->appendSrc(\Sphp\js\VENDOR_PATH . "ion.rangeSlider.min.js")
            ->appendSrc(\Sphp\js\VENDOR_PATH . "jquery.qtip.min.js")
            //->addScriptSrc(\Sphp\js\VENDOR_PATH . "jquery.unveil.min.js")
            ->useAnyTime()
            ->appendLazyload()
            ->appendPhotoAlbum()
            ->appendSrc(\Sphp\js\APP_PATH . "commonJqueryPlugins.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.form.validation.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.SideNavs.js")
            ->appendSrc(\Sphp\js\APP_PATH . "sphp.TechLinks.js")
            ->appendSrc(\Sphp\js\SPH_ALL_PATH);
    //$this->addContent((new Script())->append('sphp.initialize("' . \Sphp\HTTP_ROOT . '");'));
    return $this;
  }

}
