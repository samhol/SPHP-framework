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
class IconButtons extends AbstractComponent implements Content, IteratorAggregate {

  /**
   * @var Hyperlink[]
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

  public function __call(string $name, array $arguments): Hyperlink {
    $url = array_shift($arguments);
    $screenReaderText = array_shift($arguments);
    $target = array_shift($arguments);
    $fa = $this->fa;
    $icon =$fa($name, $screenReaderText);
    return $this->appendIcon($url, $icon, $target)->addCssClass($name);
  }

  /**
   * Appends a link
   * 
   * @param  string $url the URL of the link
   * @param  Icon $icon the icon object acting as link
   * @param  string|null $target optional target of the hyperlink
   * @return Hyperlink
   */
  protected function appendIcon(string $url, Icon $icon, string $target = null): Hyperlink {
    $hyperlink = new Hyperlink($url, $icon, $target);
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
