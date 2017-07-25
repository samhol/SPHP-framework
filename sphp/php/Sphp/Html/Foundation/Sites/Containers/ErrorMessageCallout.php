<?php

/**
 * ErrorMessageCallout.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

/**
 * Implements callout for {@link \Exception} presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorMessageCallout extends Callout {

  /**
   * the level of the error raised,
   *
   * @var int
   */
  private $errno;

  /**
   * the error message
   *
   * @var string
   */
  private $errstr;

  /**
   * the filename that the error was raised in
   *
   * @var string
   */
  private $errfile;

  /**
   * the line number the error was raised at
   *
   * @var int
   */
  private $errline;

  /**
   *
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
  public function __construct(int $errno = 0, string $errstr = '', string $errfile = '', int $errline = 0) {
    parent::__construct();
    $this->setErrno($errno)->setErrline($errline)->setErrfile($errfile)->setErrstr($errstr);
    $this->cssClasses()->lock('alert-box');
  }

  /**
   * 
   * 
   * @param  int $errno
   * @param  string $errstr
   * @param  string $errfile
   * @param  int $errline
   */
  public function __invoke(int $errno, string $errstr, string $errfile, int $errline) {
    $this->setErrno($errno)->setErrline($errline)->setErrfile($errfile)->setErrstr($errstr);
    echo $this;
  }

  /**
   * Returns the level of the error raised
   * 
   * @return int the level of the error raised
   */
  public function getErrno(): int {
    return $this->errno;
  }

  /**
   * Returns the error message
   * 
   * @return string the error message
   */
  public function getErrstr(): string {
    return $this->errstr;
  }

  /**
   * Returns the filename that the error was raised in
   * 
   * @return string the filename that the error was raised in
   */
  public function getErrfile(): string {
    return $this->errfile;
  }

  /**
   * Returns the line number the error was raised at
   * 
   * @return int the line number the error was raised at
   */
  public function getErrline(): int {
    return $this->errline;
  }

  /**
   * Sets the level of the error raised
   * 
   * @param int $errno the level of the error raised
   * @return self for a fluent interface
   */
  public function setErrno(int $errno) {
    $this->errno = $errno;
    //var_dump(\E_ALL & $errno, \E_ERROR & $errno, \E_WARNING & $errno, $errno);
    if (\E_WARNING & $errno || \E_NOTICE || \E_USER_NOTICE & $errno || \E_USER_WARNING & $errno) {
      $this->removeCssClass('alert');
      $this->addCssClass('warning');
    }
    if (\E_ERROR & $errno || \E_USER_ERROR & $errno) {
      $this->removeCssClass('warning');
      $this->addCssClass('alert');
    }
    return $this;
  }

  /**
   * Sets the error message
   * 
   * @param  string $errstr the error message
   * @return self for a fluent interface
   */
  public function setErrstr(string $errstr) {
    $this->errstr = $errstr;
    return $this;
  }

  /**
   * Sets the filename that the error was raised in
   * 
   * @param  string $errfile
   * @return self for a fluent interface
   */
  public function setErrfile($errfile) {
    $this->errfile = $errfile;
    return $this;
  }

  /**
   * Sets the line number the error was raised at
   * 
   * @param  int $errline the line number the error was raised at
   * @return self for a fluent interface
   */
  public function setErrline(int $errline) {
    $this->errline = $errline;
    return $this;
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  boolean $show true for visible file
   * @return self for a fluent interface
   */
  public function showInitialFile(bool $show = true) {
    $this->showFile = $show;
    return $this;
  }

  /**
   * Get error type string
   *
   * @return string error type string
   */
  private function getTypeString(): string {
    $type = $this->getErrno();
    if ($type & E_WARNING) {
      $return = 'E_WARNING';
    } else if ($type & E_NOTICE) {
      $return = 'E_NOTICE';
    } else if ($type & E_USER_ERROR) {
      $return = 'E_USER_ERROR';
    } else if ($type & E_USER_WARNING) {
      $return = 'E_USER_WARNING';
    } else if ($type & E_USER_NOTICE) {
      $return = 'E_USER_NOTICE';
    } else if ($type & E_STRICT) {
      $return = 'E_STRICT';
    } else if ($type & E_RECOVERABLE_ERROR) {
      $return = 'E_RECOVERABLE_ERROR';
    } else if ($type & E_DEPRECATED) {
      $return = 'E_DEPRECATED';
    } else if ($type & E_USER_DEPRECATED) {
      $return = 'E_USER_DEPRECATED';
    } else {
      $return = 'UNSPECIFIED ERROR';
    }
    return "$return ";
  }

  public function contentToString(): string {
    $output = "<i class=\"fa fa-ban\"></i><strong>" . $this->getTypeString() . ":</strong><vbr> <small>" . $this->getErrstr() . "</small></h2>";
    if ($this->showFile) {
      $output .= "on line <b>$this->errline</b> of file: <b>" . $this->getErrfile() . "</b>";
    }
    return $output. parent::contentToString();
  }

}
