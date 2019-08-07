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
use IteratorAggregate;
use Traversable;
use Sphp\Html\Iterator;
use Sphp\Html\Navigation\A;

/**
 * Implements brand icon links bar
 * 
 * @method \Sphp\Html\Navigation\A facebook(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A twitter(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A googlePlus(string $url, string $screenReaderLabel = null) creates a hyperlink new icon object
 * @method \Sphp\Html\Navigation\A github(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A tumblr(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A stumbleupon(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A pinterest(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A blogger(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IconButtons extends AbstractComponent implements Content, IteratorAggregate {

  /**
   * @var A[]
   */
  private $icons;

  /**
   *
   * @var FA
   */
  private $fa;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->icons = [];
    $this->addCssClass('sphp ', 'icon-buttons');
    $this->fa = new FA();
    $this->fa->fixedWidth(true);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->icons);
  }

  public function __call(string $name, array $arguments): A {
    $url = array_shift($arguments);
    $screenReaderText = array_shift($arguments);
    $target = array_shift($arguments);
    $fa = $this->fa;
    $icon = $fa($name, $screenReaderText);
    return $this->appendIcon($url, $icon, $target)->addCssClass($name);
  }

  public function appendLink(string $url, string $icon, string $screenreaderText = null): A {
    $this->fa->get($icon, $screenreaderText);
    return new A($url, $icon);
  }

  /**
   * Appends a link
   * 
   * @param  string $url the URL of the link
   * @param  Icon $icon the icon object acting as link
   * @param  string|null $target optional target of the hyperlink
   * @return A
   */
  protected function appendIcon(string $url, Icon $icon, string $target = null): A {
    $hyperlink = new A($url, $icon, $target);
    $hyperlink->addCssClass('sphp', 'icon-button');
    $this->icons[] = $hyperlink;
    return $hyperlink;
  }

  public function contentToString(): string {
    return implode($this->icons);
  }

  /**
   * Returns an external iterator
   *
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->rows);
  }

}
