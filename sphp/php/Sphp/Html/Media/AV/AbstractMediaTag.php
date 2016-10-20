<?php

/**
 * AbstractMediaTag.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\AbstractContainerComponent;

/**
 * Class models the HTML multimedia tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMediaTag extends AbstractContainerComponent implements MediaTagInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $tagname defines a table caption
   * @param  mixed|mixed[] $sources defines the media sources
   */
  public function __construct($tagname, $sources = null) {
    parent::__construct($tagname);
    $adder = function($source) {
      if ($source instanceof Source) {
        $this->append($source);
      } else {
        $this->addSource($source);
      }
    };
    if ($sources !== null) {
      if (!is_array($sources)) {
        $sources = [$sources];
      }
      array_map($adder, $sources);
    }
    $this->showControls(true);
  }

  public function contentToString() {
    return parent::contentToString() . "<p>Your browser does not support the &lt;" .
            $this->getTagName() . "&gt; tag!</p>";
  }

  public function append(MultimediaContentInterface $src) {
    $this->getInnerContainer()->append($src);
    return $this;
  }

  public function addSource($src, $type = null) {
    return $this->append(new Source($src, $type));
  }

  public function getSources() {
    return $this->getInnerContainer()->getComponentsByObjectType(Source::class);
  }

  public function addTrack($src, $srclang = null) {
    return $this->append(new Track($src, $srclang));
  }

  public function getTracks() {
    return $this->getInnerContainer()->getComponentsByObjectType(Track::class);
  }

  public function autoplay($autoplay = true) {
    return $this->setAttr("autoplay", (bool) $autoplay);
  }

  public function loop($loop = true) {
    return $this->setAttr("loop", (bool) $loop);
  }

  public function mute($muted = true) {
    $this->attrs()->set("muted", (bool) $muted);
    return $this;
  }

  public function showControls($show = true) {
    return $this->setAttr("controls", (bool) $show);
  }

}
