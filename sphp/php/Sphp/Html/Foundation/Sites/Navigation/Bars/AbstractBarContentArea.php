<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;

/**
 * Implements an abstract Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractBarContentArea extends AbstractComponent implements BarContentArea {

  /**
   * @var PlainContainer
   */
  private $content;

  /**
   * Constructor
   *
   * @param string $tagname the tag name of the container
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
    $this->content = new PlainContainer();
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  public function append($content) {
    $this->content->append($content);
    return $this;
  }

  public function prepend($content) {
    $this->content->prepend($content);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

}
