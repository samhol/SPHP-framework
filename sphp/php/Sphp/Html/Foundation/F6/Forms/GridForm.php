<?php

/**
 * GridForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\AbstractForm as AbstractForm;
use Sphp\Html\Foundation\F6\Core\GridInterface as GridInterface;

/**
 * Class implements a Foundation framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-16
 * @version 1.0.1
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GridForm extends AbstractForm implements GridInterface {

  use FormGridTrait;

  /**
   * Constructs a new instance of the {@link self} object
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
    parent::__construct($action, $method);
    if ($content !== null) {
      $this->append($content);
    }
  }

}
