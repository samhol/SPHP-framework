<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\PlainContainer;
use Sphp\Html\Container;

/**
 * Implements an XY Grid Cell
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContainerCell extends AbstractCell {

  /**
   * @var PlainContainer 
   */
  private $content;

  /**
   * Constructor
   * 
   * @param mixed $content
   * @param array $opts
   */
  public function __construct($content = null, array $opts = []) {
    parent::__construct();
    $this->content = new PlainContainer;
    if ($content !== null) {
      $this->appendContent($content);
    }
    $this->setLayouts($opts);
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function getContent(): Container {
    return $this->content;
  }

  public function appendContent($content) {
    $this->content->append($content);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public static function create($content, array $layout = []): ContainerCell {
    return new static($content, $layout);
  }

}
