<?php

/**
 * CalloutBuilder.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Config\ErrorHandling\ErrorListener;
use Sphp\Html\Foundation\Sites\Containers\Callout;
use Sphp\Html\Icons\Icons;
use Sphp\Html\Icons\Icon;

/**
 * Implements a callout builder for PHP error message presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CalloutBuilder implements ErrorListener {

  /**
   * @var bool
   */
  private $closable;

  /**
   * @var bool
   */
  private $showFile;

  /**
   * Constructs a new instance
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
   * @param int $errno
   * @return Icon
   */
  protected function getIcon(int $errno): Icon {
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $iconName = 'fa-ban';
    } else {
      $iconName = 'fa-exclamation-circle';
    }
    return Icons::fontAwesome($iconName);
  }

  protected function buildCallout(int $errno): Callout {
    $callout = new Callout();
    $callout->setClosable($this->closable);
    $callout->cssClasses()->lock('alert-box');
    if (\E_WARNING & $errno || \E_NOTICE || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $callout->addCssClass('warning');
    }
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $callout->addCssClass('alert');
    }
    return $callout;
  }

  public function onError(int $errno, string $errstr, string $errfile, int $errline) {
    $callout = $this->buildCallout($errno);
    //$this->setClasses($callout, $errno);  fa-exclamation-circle
    $callout->append("<h2>". $this->getIcon($errno) . $this->getTypeString($errno) . ": <small>" . $errstr . "</small></h2>");
    if ($this->showFile) {
      $callout->append("on line <strong>$errline</strong> of file: <strong>" . $errfile . "</strong>");
    }
    echo $callout;
  }

}
