<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Config\ErrorHandling\ErrorListener;
use Sphp\Config\ErrorHandling\Views\ErrorSectionBuilder;
use Stringable;

/**
 * Implements an alert builder for PHP error message presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorAlertBuilder implements ErrorListener {

  private bool $closable = false;
  private ErrorSectionBuilder $sectionBuilder;

  /**
   * Constructor
   * 
   * @param ErrorSectionBuilder|null $sectionBuilder
   */
  public function __construct(?ErrorSectionBuilder $sectionBuilder = null) {
    if ($sectionBuilder === null) {
      $sectionBuilder = new ErrorSectionBuilder();
    }
    $this->sectionBuilder = $sectionBuilder;
  }

  public function __destruct() {
    unset($this->sectionBuilder);
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  bool $closable true for visible file
   * @return $this for a fluent interface
   */
  public function setClosable(bool $closable = true) {
    $this->closable = $closable;
    return $this;
  }

  /**
   * Sets the visibility of the file information
   * 
   * @param  bool $show true if the file information is visible
   * @return $this for a fluent interface
   */
  public function showFileInformation(bool $show) {
    $this->sectionBuilder->showFileInformation($show);
    return $this;
  }

  /**
   * PHP Error handling method
   * 
   * @param  int $errno the level of the error raised
   * @param  string $errstr the error message
   * @param  string $errfile the filename that the error was raised in
   * @param  int $errline the line number the error was raised at
   * @return string|Stringable PHP Error as HTML content 
   */
  public function build(int $errno, string $errstr, string $errfile, int $errline): string|Stringable {
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $alert = new Alert('alert-danger', true);
    } else if (\E_WARNING & $errno || \E_NOTICE || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $alert = new Alert('alert-warning', true);
    }
    $alert->append($this->sectionBuilder->build($errno, $errstr, $errfile, $errline));
    return $alert;
  }

  public function onError(int $errno, string $errstr, string $errfile, int $errline): void {
    echo $this->build($errno, $errstr, $errfile, $errline);
  }

}
