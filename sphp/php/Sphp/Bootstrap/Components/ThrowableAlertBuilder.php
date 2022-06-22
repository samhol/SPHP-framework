<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Config\ErrorHandling\ExceptionListener;
use Stringable;
use Throwable;
use Sphp\Config\ErrorHandling\Views\ThrowableSectionBuilder;

/**
 * Implements Foundation Callout for Exception presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ThrowableAlertBuilder implements ExceptionListener {

  private ThrowableSectionBuilder $sect;
  private bool $closable = false;

  /**
   * Constructor
   *
   * @param  ThrowableSectionBuilder|null $sect
   */
  public function __construct(?ThrowableSectionBuilder $sect = null) {
    if ($sect === null) {
      $sect = new ThrowableSectionBuilder();
    }
    $this->sect = $sect;
  }

  /**
   * Destructs the instance
   */
  public function __destruct() {
    unset($this->sect);
  }

  /**
   * Invokes the builder
   * 
   * @param  Throwable $e
   * @return void
   */
  public function __invoke(Throwable $e): Stringable|string {
    return $this->build($e);
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  bool $closable true for visible file
   * @return $this for a fluent interface
   */
  public function setClosable(bool $closable) {
    $this->closable = $closable;
    return $this;
  }

  public function getBuilder(): ThrowableSectionBuilder {
    return $this->sect;
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  bool $show true for visible file
   * @return $this for a fluent interface
   */
  public function showInitialFile(bool $show) {
    $this->getBuilder()->showInitialFile($show);
    return $this;
  }

  /**
   * Sets the trace visibility
   * 
   * @param  bool $show true for visible trace  
   * @return $this for a fluent interface
   */
  public function showTrace(bool $show) {
    $this->getBuilder()->showTrace($show);
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  bool $show true for visible previous exception
   * @return $this for a fluent interface
   */
  public function showPreviousException(bool $show) {
    $this->getBuilder()->showPreviousException($show);
    return $this;
  }

  /**
   * Creates the callout object
   * 
   * @param  Throwable $e object thrown
   * @return Alert the object created
   */
  public function build(Throwable $e): Alert {
    $alert = new Alert('alert-danger');
    $alert->showDismissButton($this->closable);
    $alert->cssClasses()->protectValue('sphp-throwable-alert');
    $alert->append($this->getBuilder()->build($e));
    return $alert;
  }

  public function onException(Throwable $e): void {
    $this->build($e)->printHtml();
  }

}
