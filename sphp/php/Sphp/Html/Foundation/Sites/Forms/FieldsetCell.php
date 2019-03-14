<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Grids\AbstractCell;
use Sphp\Html\PlainContainer;
use Sphp\Html\Forms\Legend;

/**
 * Description of FieldsetCell
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FieldsetCell extends AbstractCell {

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
  public function __construct($legend = null, array $opts = []) {
    parent::__construct('fieldset');
    $this->content = new PlainContainer;
    $this->legend = new Legend($legend);
    $this->setLayouts($opts);
  }

  public function contentToString(): string {
    $output = $this->legend;
    $output .= $this->content;
    return $output;
  }
  public function append($content) {
    $this->content->append($content);
    return $this;
  }

}
