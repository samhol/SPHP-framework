<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\AbstractForm;
use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Foundation\Sites\Grids\Grid;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;

/**
 * Implements a framework form
 *
 * A {@link GridForm} is built with a combination of standard form
 * elements, as well as the Foundation Grid ({@link Row}(s) and {@link Column}(s)).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/docs/components/forms.html Foundation forms
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class GridForm extends AbstractForm {

  /**
   * @var ContentCallout
   */
  private $errorLabel;

  /**
   * @var DivGrid 
   */
  private $grid;

  /**
   * Constructor
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
  public function __construct(string $action = null, string $method = null) {
    parent::__construct();
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method !== null) {
      $this->setMethod($method);
    }
    $this->errorLabel = new ContentCallout('<i class="fas fa-exclamation-triangle"></i> There are some errors in your form.');
    $this->errorLabel->cssClasses()->protectValue('alert');
    $this->errorLabel->inlineStyles()->setProperty('display', 'none');
    $this->errorLabel->attributes()->demand('data-abide-error');
    $this->grid = new DivGrid();
  }

  public function __destruct() {
    unset($this->errorLabel, $this->grid);
    parent::__destruct();
  }

  public function useValidation(bool $validate = true) {
    $this->attributes()->setAttribute('novalidate', $validate)->setAttribute('data-abide', $validate);
    return $this;
  }

  public function validateOnBlur(bool $validate = true) {
    if ($validate) {
      $this->useValidation();
    }
    $this->attributes()->setAttribute('data-validate-on-blur', $validate ? 'true' : 'false');
    return $this;
  }

  public function liveValidate(bool $validate = true) {
    if ($validate) {
      $this->useValidation();
    }
    $this->attributes()->setAttribute('data-live-validate', $validate ? 'true' : 'false');
    return $this;
  }

  /**
   * 
   * @param  string $message
   * @return $this for a fluent interface
   */
  public function setFormErrorMessage($message) {
    $this->errorLabel->resetContent($message);
    return $this;
  }

  public function contentToString(): string {
    $output = '<div class="grid-container"><div class="grid-x"><div class="cell">'.$this->errorLabel.'</div></div></div>';
    return $output. $this->getGrid()->getHtml() . $this->getHiddenInputs();
  }

  public function getGrid(): Grid {
    return $this->grid;
  }

  /**
   * Appends a new row to the grid
   *
   * @param  mixed|Row $row the new row or the content of the new row
   * @return Row appended instance
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row): Row {
    return $this->getGrid()->append($row);
  }

  /**
   * Prepends a new row to the grid
   *
   * @param  mixed|Row $row the new row or the content of the new row
   * @return Row prepended instance
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row): Row {
    return $this->getGrid()->prepend($row);
  }

}
