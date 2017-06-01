<?php

/**
 * Closable.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\ComponentInterface;
use Sphp\Html\ContainerComponentInterface;

/**
 * Implements a Foundation Equalizer.
 *
 * Equalizer makes it dead simple to gives multiple items equal height.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Closable extends \Sphp\Html\AbstractComponent {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var ContainerComponentInterface
   */
  private $component;

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $closable
   * @param string|null $name
   */
  public function __construct(ContainerComponentInterface $closable) {
    $this->component = $closable;
  }

  public function getHtml() {
    $this->component;
 
    parent::getHtml();
  }

}
