<?php

/**
 * AbstractMultimediaTag.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\Container;

/**
 * Implements an abstract HTML multimedia tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMultimediaTag extends AbstractComponent implements \IteratorAggregate, \Sphp\Html\TraversableInterface, MediaTagInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   *
   * @var Container
   */
  private $sources;

  /**
   *
   * @var Container
   */
  private $tracks;

  /**
   * Constructs a new instance
   *
   * @param  string $tagname the name of the tag
   * @param  AttributeManager|null $attrManager optional attribute manager to use in the component
   * @param mixed $sources optional sources
   */
  public function __construct($tagname, AttributeManager $attrManager = null, $sources = null) {
    parent::__construct($tagname, $attrManager);
    $this->sources = new Container();
    $this->tracks = new Container();
    if ($sources !== null) {
      foreach (is_array($sources) ? $sources : [$sources] as $src) {
        if ($src instanceof Source) {
          $this->addMediaSrc($src);
        } else if (is_string($src)) {
          $this->addSource($src);
        }
      }
    }
  }

  public function __destruct() {
    unset($this->sources, $this->tracks);
    parent::__destruct();
  }

  public function contentToString() {
    return $this->sources->getHtml()
            . $this->tracks->getHtml()
            . "<p>Your browser does not support the &lt;"
            . $this->getTagName() . "&gt; tag!</p>";
  }

  public function addMediaSrc(MultimediaContentInterface $src) {
    if ($src instanceof Source) {
      $this->sources->append($src);
    }
    if ($src instanceof Track) {
      $this->tracks->append($src);
    }
    return $this;
  }

  public function addSource($src, $type = null) {
    return $this->addMediaSrc(new Source($src, $type));
  }

  public function getSources() {
    return $this->sources->getIterator();
  }

  public function addTrack($src, $srclang = null) {
    return $this->addMediaSrc(new Track($src, $srclang));
  }

  public function getTracks() {
    return $this->tracks->getIterator();
  }

  public function autoplay($autoplay = true) {
    $this->attrs()->set('autoplay', (bool) $autoplay);
    return $this;
  }

  public function loop($loop = true) {
    $this->attrs()->set('loop', (bool) $loop);
    return $this;
  }

  public function mute($muted = true) {
    $this->attrs()->set('muted', (bool) $muted);
    return $this;
  }

  public function showControls($show = true) {
    $this->attrs()->set('controls', (bool) $show);
    return $this;
  }

  public function count($mode = 'source') {
    $num = 0;
    if ($mode === 'source') {
      $num += $this->sources->count();
    } if ($mode === 'track') {
      $num += $this->sources->count();
    } else {
      
    }
    return $this->sources->count();
  }

  public function getIterator() {
    return new \Sphp\Html\Iterator($this->tracks->toArray(), $this->sources->toArray());
  }

}
