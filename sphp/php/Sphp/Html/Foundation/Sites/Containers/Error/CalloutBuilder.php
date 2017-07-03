<?php

/**
 * ErrorMessageCallout.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Error;

use Sphp\Html\ContentInterface;
use Sphp\Html\Foundation\Sites\Containers\Callout;

/**
 * Implements callout for {@link \Exception} presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CalloutBuilder implements \Sphp\Config\ErrorHandling\ErrorListener {

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
   * @param  int $errno
   * @param  string $errstr
   * @param  string $errfile
   * @param  int $errline
   */
  public function __construct(bool $show = true, bool $closable = true) {
    $this->showFileInformation($show);
    $this->setClosable($closable);
  }

  public function setClosable(bool $closable = true) {
    $this->closable = $closable;
    return $this;
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  boolean $show true for visible file
   * @return self for a fluent interface
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

  protected function setClasses(Callout $c, int $errno) {
    $c->cssClasses()->lock('alert-box');
    if (\E_WARNING & $errno || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $c->removeCssClass('alert');
      $c->addCssClass('warning');
    }
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $c->removeCssClass('warning');
      $c->addCssClass('alert');
    }
  }

  protected function buildCallout(): Callout {
    $callout = new Callout();
    $callout->setClosable($this->closable);

    return $callout;
  }

  public function onError(int $errno, string $errstr, string $errfile, int $errline): string {
    $callout = $this->buildCallout();
    $this->setClasses($callout, $errno);
    $callout->append("<h2><i class=\"fa fa-ban\"></i>" . $this->getTypeString($errno) . ": <small>" . $errstr . "</small></h2>");
    if ($this->showFile) {
      $callout->append("on line <b>$errline</b> of file: <b>" . $errfile . "</b>");
    }
    return $callout->getHtml();
  }

}
