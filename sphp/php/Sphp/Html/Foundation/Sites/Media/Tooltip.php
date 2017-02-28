<?php

/**
 * Tooltip.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\ContentInterface;
use Sphp\Html\ContentTrait;
use Sphp\Html\ComponentInterface;

/**
 * Implements a Tooltip component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-30
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tooltip.html Tooltip
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tooltip implements ContentInterface {

  use ContentTrait;

  /**
   *
   * @var ComponentInterface 
   */
  private $toolTipped;

  /**
   * 
   * @param ComponentInterface $toolTipped
   */
  public function __construct(ComponentInterface $toolTipped, $tip = null) {
    $this->toolTipped = $toolTipped;
    $this->toolTipped->attrs()
            ->demand('data-tooltip')
            ->lock('aria-haspopup', 'true')
            ->set('data-disable-hover', 'false');
    $this->toolTipped->cssClasses()->lock('has-tip');
    if ($tip !== null) {
      $this->setTip($tip);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->toolTipped);
  }

  /**
   * Returns the tipped component
   * 
   * @return ComponentInterface the tipped component
   */
  public function getComponent() {
    return $this->toolTipped;
  }

  /**
   * 
   * @param  string $tip the tip content
   * @return self for a fluent interface
   */
  public function setTip($tip) {
    $this->toolTipped->attrs()->set('title', $tip);
    return $this;
  }

  public function getHtml() {
    return $this->toolTipped->getHtml();
  }

}
