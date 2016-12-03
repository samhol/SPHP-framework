<?php

/**
 * GridForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use IteratorAggregate;
use Sphp\Html\Forms\TraversableFormInterface;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Foundation\Sites\Grids\GridInterface;
use Sphp\Html\Forms\TraversableFormTrait;
use Sphp\Html\Foundation\Sites\Containers\Callout;

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
class GridForm extends AbstractContainerComponent implements IteratorAggregate, GridInterface, TraversableFormInterface {

  use FormGridTrait,
      TraversableFormTrait;

  /**
   *
   * @var Callout
   */
  private $errorLabel;

  /**
   * Constructs a new instance
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == get|post`
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed|null $content the content of the form or null for no content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = null, $method = 'post', $content = null) {
    parent::__construct('form');
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method !== '') {
      $this->setMethod($method);
    }
    if ($content !== null) {
      $this->append($content);
    }
    $this->errorLabel = new Callout('<i class="fi-alert"></i> There are some errors in your form.');
    $this->errorLabel->hide()->cssClasses()->lock('alert');
    $this->errorLabel->attrs()->demand('data-abide-error');
  }

  /**
   * 
   * @param   $message
   * @return self for PHP Method Chaining
   */
  public function setFormErrorMessage($message) {
    $this->errorLabel->replaceContent($message);
    return $this;
  }

  public function validation($validate = true) {
    $this->attrs()->set('novalidate', $validate)->set('data-abide', $validate);
    return $this;
  }

  public function contentToString() {
    return $this->errorLabel . parent::contentToString();
  }

}
