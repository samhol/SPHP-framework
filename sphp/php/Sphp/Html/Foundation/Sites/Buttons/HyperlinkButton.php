<?php

/**
 * HyperlinkButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Class implements an HTML &lt;a&gt; tag as a Foundation Button in PHP
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-22
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkButton extends Hyperlink implements ButtonInterface {

  use ButtonTrait;

  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct($href, $content, $target);
    $this->cssClasses()->lock('button');
  }

}
