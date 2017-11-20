<?php

/**
 * AbstractMultimediaTag.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Container;

/**
 * Implements an abstract HTML multimedia tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMultimediaTag extends AbstractComponent implements \IteratorAggregate, \Sphp\Html\TraversableInterface, MediaTagInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Container
   */
  private $sources;

  /**
   * @var Container
   */
  private $tracks;

  /**
   * Constructs a new instance
   *
   * @param string $tagname the name of the tag
   * @param HtmlAttributeManager|null $attrManager optional attribute manager to use in the component
   * @param mixed $sources optional sources
   */
  public function __construct(string $tagname, HtmlAttributeManager $attrManager = null, $sources = null) {
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

  public function contentToString(): string {
    return $this->sources->getHtml()
            . $this->tracks->getHtml()
            . "<p>Your browser does not support the &lt;"
            . $this->getTagName() . "&gt; tag!</p>";
  }

  public function addMediaSrc(MultimediaSource $src) {
    if ($src instanceof Source) {
      $this->sources->append($src);
    }
    if ($src instanceof Track) {
      $this->tracks->append($src);
    }
    return $this;
  }

  public function addSource(string $src, string $type = null) {
    return $this->addMediaSrc(new Source($src, $type));
  }

  public function getSources() {
    return $this->sources->getIterator();
  }

  public function addTrack(string $src, string $srclang = null) {
    return $this->addMediaSrc(new Track($src, $srclang));
  }

  public function getTracks() {
    return $this->tracks->getIterator();
  }

  public function autoplay(bool $autoplay = true) {
    $this->attrs()->set('autoplay', (bool) $autoplay);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->attrs()->set('loop', (bool) $loop);
    return $this;
  }

  public function mute(bool $muted = true) {
    $this->attrs()->set('muted', (bool) $muted);
    return $this;
  }

  public function showControls(bool $show = true) {
    $this->attrs()->set('controls', (bool) $show);
    return $this;
  }

  public function count($mode = 'source'): int {
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
