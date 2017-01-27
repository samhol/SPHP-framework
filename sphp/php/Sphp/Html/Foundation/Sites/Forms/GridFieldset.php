<?php

/**
 * GridFieldset.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\Fieldset;
use Sphp\Html\Foundation\Sites\Grids\GridInterface;
use Sphp\Html\Forms\Legend;

/**
 * Implements a framework Grid based Fieldset component for HTML forms
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-16
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridFieldset extends Fieldset implements GridInterface {

  use FormGridTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|Legend $legend the legend of the fieldset component
   * @param  mixed|mixed[] $content the content of the component
   */
  public function __construct($legend = null, $content = null) {
    parent::__construct($legend);
    if ($content !== null) {
      $this->append($content);
    }
  }

}
