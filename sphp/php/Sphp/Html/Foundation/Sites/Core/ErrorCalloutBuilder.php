<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Config\ErrorHandling\ErrorListener;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Media\Icons\Icon;
use Sphp\Html\Media\Icons\FA;

/**
 * Implements a callout builder for PHP error message presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ErrorCalloutBuilder implements ErrorListener {

  /**
   * @var bool
   */
  private $closable;

  /**
   * @var bool 
   */
  private $showFile;

  /**
   * Constructor
   *
   * @param bool $showFileInformation if the file information is visible
   * @param bool $closable true if the callout is closable
   */
  public function __construct(bool $showFileInformation = true, bool $closable = true) {
    $this->showFileInformation($showFileInformation);
    $this->setClosable($closable);
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  boolean $closable true for visible file
   * @return $this for a fluent interface
   */
  public function setClosable(bool $closable = true) {
    $this->closable = $closable;
    return $this;
  }

  /**
   * Sets the visibility of the file information
   * 
   * @param  boolean $show true if the file information is visible
   * @return $this for a fluent interface
   */
  public function showFileInformation(bool $show = true) {
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
  protected function getIcon(int $errno): Icon {
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      return FA::ban()->setSize('2x');
    } else {
      return FA::exclamation()->setSize('2x');
    }
  }

  /**
   * 
   * @param  int $errno
   * @return ContentCallout
   */
  protected function buildCallout(int $errno): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable($this->closable);
    $callout->cssClasses()->protectValue('alert-box');
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $callout->addCssClass('alert');
    } else if (\E_WARNING & $errno || \E_NOTICE || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $callout->addCssClass('warning');
    }
    return $callout;
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
    $callout = $this->buildCallout($errno);
    //$this->setClasses($callout, $errno);  fa-exclamation-circle
    $callout->append("<div class=\"type\"><span class='icon'>" . $this->getIcon($errno) . '</span> ' . $this->getTypeString($errno) . "</div>");
    $callout->append("<div class=\"message\">{$this->parseMessage($errstr)}</div>");
    if ($this->showFile) {
      $callout->append("<div class=\"file-info\">on line <strong>$errline</strong> of file:");
      $callout->append('<div class="file-path">' . str_replace('/', '<wbr>/', $errfile) . "</div></div>");
    }
    echo $callout;
  }

}
