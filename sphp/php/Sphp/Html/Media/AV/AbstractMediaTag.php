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

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return parent::contentToString() . "<p>Your browser does not support the &lt;" .
            $this->getTagName() . "&gt; tag!</p>";
  }

  /**
   * {@inheritdoc}
   */
  public function append(MultimediaContentInterface $src) {
    $this->content()->append($src);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function addSource($src, $type = null) {
    return $this->append(new Source($src, $type));
  }

  /**
   * {@inheritdoc}
   */
  public function getSources() {
    return $this->content()->getComponentsByObjectType(Source::class);
  }

  /**
   * {@inheritdoc}
   */
  public function addTrack($src, $srclang = null) {
    return $this->append(new Track($src, $srclang));
  }

  /**
   * {@inheritdoc}
   */
  public function getTracks() {
    return $this->content()->getComponentsByObjectType(Track::class);
  }

  /**
   * {@inheritdoc}
   */
  public function autoplay($autoplay = true) {
    return $this->setAttr("autoplay", (bool) $autoplay);
  }

  /**
   * {@inheritdoc}
   */
  public function loop($loop = true) {
    return $this->setAttr("loop", (bool) $loop);
  }

  /**
   * {@inheritdoc}
   */
  public function mute($muted = true) {
    $this->attrs()->set("muted", (bool) $muted);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function showControls($show = true) {
    return $this->setAttr("controls", (bool) $show);
  }

}
