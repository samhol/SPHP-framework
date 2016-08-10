<?php

/**
 * Input.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Inputs\ValidableInputInterface as ValidableInputInterface;
use Sphp\Html\Forms\Inputs\ValidableInputTrait as ValidableInputTrait;
use Sphp\Html\Forms\LabelableInterface as LabelableInterface;
use Sphp\Html\Forms\LabelableTrait as LabelableTrait;

/**
 * Class Models an HTML &lt;input&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-08-17
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputTag extends AbstractInputTag implements ValidableInputInterface, LabelableInterface {

  use LabelableTrait,
      ValidableInputTrait;
}
