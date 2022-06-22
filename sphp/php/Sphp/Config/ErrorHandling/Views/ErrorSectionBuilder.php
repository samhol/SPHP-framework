<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling\Views;

use Sphp\Config\ErrorHandling\ErrorListener;
use Sphp\Media\Icons\Icon;
use Sphp\Media\Icons\FontAwesome;
use Sphp\Html\Layout\Section;
use Sphp\Html\Lists\Ul;
use Stringable;
use Sphp\Html\Tags;

/**
 * Implements an alert builder for PHP error message presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorSectionBuilder implements ErrorListener {

  private bool $showFile = false;

  /**
   * Sets the visibility of the file information
   * 
   * @param  bool $show true if the file information is visible
   * @return $this for a fluent interface
   */
  public function showFileInformation(bool $show) {
    $this->showFile = $show;
    return $this;
  }

  /**
   * Get error type string
   *
   * @param  int $errno PHP error number constant
   * @return string error type string
   */
  private function getTypeString(int $errno): string {
    if ($errno & E_WARNING) {
      $return = 'E_WARNING';
    } else if ($errno & E_NOTICE) {
      $return = 'E_NOTICE';
    } else if ($errno & E_USER_ERROR) {
      $return = 'E_USER_ERROR';
    } else if ($errno & E_USER_WARNING) {
      $return = 'E_USER_WARNING';
    } else if ($errno & E_USER_NOTICE) {
      $return = 'E_USER_NOTICE';
    } else if ($errno & E_STRICT) {
      $return = 'E_STRICT';
    } else if ($errno & E_RECOVERABLE_ERROR) {
      $return = 'E_RECOVERABLE_ERROR';
    } else if ($errno & E_DEPRECATED) {
      $return = 'E_DEPRECATED';
    } else if ($errno & E_USER_DEPRECATED) {
      $return = 'E_USER_DEPRECATED';
    } else {
      $return = 'UNSPECIFIED ERROR';
    }
    return $return;
  }

  /**
   * 
   * @param int $errno PHP error number constant
   * @return Icon
   */
  private function getIcon(int $errno): Icon {
    $fa = new FontAwesome();
    $fa->setSize('lg')->fixedWidth(true);
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      return $fa('fas fa-ban');
    } else if (E_NOTICE & $errno || \E_USER_NOTICE & $errno) {
      return $fa('fa-solid fa-exclamation');
    } else {
      return $fa('fa-solid fa-exclamation-triangle');
    }
  }

  /**
   *  
   * @param  int $errno the level of the error raised
   * @param  string $errstr the error message
   * @param  string $errfile the filename that the error was raised in
   * @param  int $errline the line number the error was raised at
   * @return string|Stringable PHP Error as HTML content 
   */
  private function buildContent(int $errno, string $errstr, string $errfile, int $errline) {
    $list = new Ul();
    $list->append(Tags::strong('Message: ' . Tags::var($errstr)));
    $list->append(Tags::strong('File: ' . Tags::var($errfile)));
    $list->append(Tags::strong('Line: ' . Tags::var($errline)));
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
    $output = new Section();
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $output->addCssClass('error');
    } else if (\E_WARNING & $errno || \E_NOTICE || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $output->addCssClass('warning');
    }
    $output->appendH2("<span class='icon'>" . $this->getIcon($errno) . '</span> ' . $this->getTypeString($errno));
    $output->appendStrong($this->parseMessage($errstr));
    if ($this->showFile) {
      $output->appendDiv("on line <var>$errline</var> of file:");
      $output->appendDiv('<var class="file-path">' . str_replace('/', '<wbr>/', $errfile) . "</var>");
    }
    return $output;
  }

  /**
   * 
   * @param  string $message
   * @return string
   */
  protected function parseMessage(string $message): string {
    return str_replace(['\\', '/', '.'], ['\\<wbr>', '/<wbr>', '.<wbr>'], $message);
  }

  public function onError(int $errno, string $errstr, string $errfile, int $errline): void {
    echo $this->build($errno, $errstr, $errfile, $errline);
  }

}
