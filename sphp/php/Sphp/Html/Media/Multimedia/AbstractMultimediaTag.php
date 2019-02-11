<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\PlainContainer;
use Traversable;
use Sphp\Html\Iterator;
use Sphp\Html\TraversableContent;

/**
 * Implements an abstract HTML multimedia tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractMultimediaTag extends AbstractComponent implements \IteratorAggregate, \Sphp\Html\TraversableContent, MediaTag {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var MultimediaSource[]
   */
  private $sources;

  /**
   * Constructor
   *
   * @param string $tagname the name of the tag
   * @param HtmlAttributeManager|null $attrManager optional attribute manager to use in the component
   * @param mixed $sources optional sources
   */
  public function __construct(string $tagname, HtmlAttributeManager $attrManager = null, $sources = null) {
    parent::__construct($tagname, $attrManager);
    $this->sources = [];
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
    unset($this->sources);
    parent::__destruct();
  }

  public function contentToString(): string {
    return implode($this->sources)
            . "<p>Your browser does not support the &lt;"
            . $this->getTagName() . "&gt; tag!</p>";
  }

  public function addMediaSrc(MultimediaSource $src) {
    $this->sources[] = $src;
    return $this;
  }

  public function addSource(string $src, string $type = null): Source {
    $source = new Source($src, $type);
    $this->addMediaSrc($source);
    return $source;
  }

  public function addTrack(string $src, string $srclang = null): Track {
    $track = new Track($src, $srclang);
    $this->addMediaSrc($track);
    return $track;
  }

  public function autoplay(bool $autoplay = true) {
    $this->attributes()->setAttribute('autoplay', (bool) $autoplay);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->attributes()->setAttribute('loop', (bool) $loop);
    return $this;
  }

  public function mute(bool $muted = true) {
    $this->attributes()->setAttribute('muted', (bool) $muted);
    return $this;
  }

  public function showControls(bool $show = true) {
    $this->attributes()->setAttribute('controls', (bool) $show);
    return $this;
  }

  /**
   * Counts source and/or track components
   * 
   * @param  string $mode
   * @return int number of source and/or track components
   */
  public function count(string $mode = MultimediaSource::class): int {
    $num = 0;
    if ($mode === 'source') {
      $num += $this->sources->count();
    } if ($mode === 'track') {
      $num += $this->sources->count();
    } else {
      
    }
    return $this->sources->count();
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->sources);
  }

  public function getSources(): iterable {
    return (new Iterator($this->sources))->getComponentsByObjectType(Source::class)->toArray();
  }

  public function getTracks(): iterable {
    return (new Iterator($this->sources))->getComponentsByObjectType(Track::class)->toArray();
  }

}
