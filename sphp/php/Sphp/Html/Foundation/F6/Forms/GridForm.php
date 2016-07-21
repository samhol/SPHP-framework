<?php

/**
 * GridForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\TraversableFormInterface as TraversableFormInterface;
use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\Foundation\F6\Grids\GridInterface as GridInterface;
use Sphp\Html\Forms\TraversableFormTrait as TraversableFormTrait;

/**
 * Class implements a Foundation framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-16
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridForm extends AbstractContainerComponent implements GridInterface, TraversableFormInterface {

  use FormGridTrait,
      TraversableFormTrait;

  /**
   * Constructs a new instance
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed $content the content of the form
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = "", $method = "post", $content = null) {
    parent::__construct(self::TAG_NAME);
    if ($action != "") {
      $this->setAction($action);
    }
    if ($method != "") {
      $this->setMethod($method);
    }
    if ($content !== null) {
      $this->append($content);
    }
  }

}
