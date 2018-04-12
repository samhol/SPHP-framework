<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;

/**
 * Implements a Foundation Badge
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Badge extends AbstractComponent {

  private $content;

  public function __construct($content = null) {
    parent::__construct('span');
    $this->cssClasses()->protect('badge');
    if ($content !== null) {
      $this->content = $content;
    }
  }

  public function contentToString(): string {
    return "$this->content";
  }

}
