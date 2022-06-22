<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures;

use Sphp\Html\AbstractComponent;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use IteratorAggregate;
use Sphp\Html\ContentIterator;

/**
 * Implementation of an HTML picture tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @link    https://www.w3schools.com/tags/tag_picture.asp w3schools API
 * @filesource
 */
class Picture extends AbstractComponent implements IteratorAggregate {

  /**
   * @var PriorityQueue<Source> 
   */
  private PriorityQueue $sources;
  private Img $img;

  public function __construct(string|Img|null $img = null, string|Source ... $source) {
    parent::__construct('picture');
    if (!($img instanceof Img)) {
      $img = new Img((string) $img);
    }
    $this->img = $img;
    $this->sources = new PriorityQueue();
    foreach ($source as $src) {
      if ($src instanceof Source) {
        $this->addSource($src);
      } else {

        $this->addNewSource($src);
      }
    }
  }

  public function __destruct() {
    unset($this->sources, $this->img);
    parent::__destruct();
  }

  public function __clone() {
    $this->sources = Arrays::copy($this->sources);
    $this->img = clone $this->img;
    parent::__clone();
  }

  public function getImg(): Img {
    return $this->img;
  }

  /**
   * 
   * @param Source $source
   * @param int $priority
   * @return $this for a fluent interface
   */
  public function addSource(Source $source, int $priority = 0) {
    $this->sources->enqueue($source, $priority);
    return $this;
  }

  /**
   * 
   * @param string $srcset
   * @param string|null $media
   * @param  int $priority
   * @return Source
   */
  public function addNewSource(string $srcset, ?string $media = null, int $priority = 0): Source {
    $source = new Source($srcset, $media);
    $this->addSource($source, $priority);
    return $source;
  }

  public function contentToString(): string {
    $out = implode('', $this->sources->toArray());
    $out .= $this->img;
    return $out;
  }

  public function getIterator(): ContentIterator {
    $arr = $this->sources->toArray();
    $arr[] = $this->img;
    return new ContentIterator($arr);
  }

}
