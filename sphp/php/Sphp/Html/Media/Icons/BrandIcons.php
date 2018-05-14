<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Content;
use Iterator;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements brand icon links bar
 * 
 * @method \Sphp\Html\Navigation\Hyperlink facebook(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink twitter(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink googlePlus(string $url, string $screenReaderLabel = null) creates a hyperlink new icon object
 * @method \Sphp\Html\Navigation\Hyperlink github(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink tumblr(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink stumbleupon(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink pinterest(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\Hyperlink blogger(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BrandIcons extends AbstractComponent implements Content, Iterator {

  /**
   * @var Hyperlink[]
   */
  private $icons;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->icons = [];
    $this->addCssClass('sphp-brand-links', 'logo');
    $this->fa = FontAwesome::instance();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->icons);
  }

  public function __call($name, $arguments): Hyperlink {
    $url = array_shift($arguments);
    $screenReaderText = array_shift($arguments);
    $target = array_shift($arguments);
    $icon = $this->fa->$name($screenReaderText);
    return $this->appendIcon($url, $icon, $target)->addCssClass($name);
  }

  /**
   * Appends a link
   * 
   * @param  string $url the URL of the link
   * @param  IconInterface $icon the icon object acting as link
   * @param  string|null $target optional target of the hyperlink
   * @return Hyperlink
   */
  protected function appendIcon(string $url, IconInterface $icon, string $target = null): Hyperlink {
    $hyperlink = new Hyperlink($url, $icon, $target);
    $hyperlink->addCssClass('sphp-brand-link');
    $this->icons[] = $hyperlink;
    return $hyperlink;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->icons);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->icons);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->icons);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->icons);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->icons);
  }

  public function contentToString(): string {
    return implode($this->icons);
  }

}
