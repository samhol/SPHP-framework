<?php

/**
 * ErrorEvent.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

/**
 * Event object that can also act as a container for any type of data.
 *
 * Implements an event. Objects can 'subscribe'
 * to these events and get notified when they trigger.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorEvent {

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
   * Constructs a new instance
   *
   * @param  int $errno
   * @param  string $errstr
   * @param  string $errfile
   * @param  int $errline
   */
  public function __construct(int $errno, string $errstr, string $errfile, int $errline) {
    $this->errno = $errno;
    $this->errstr = $errstr;
    $this->errfile = $errfile;
    $this->errline = $errline;
  }

  /**
   * Return the string representation of the event object
   *
   * @return string the string representation of the event object
   */
  public function __toString(): string {
    return __CLASS__ . " : (name: $this->errno)";
  }

  public function getErrno(): int {
    return $this->errno;
  }

  public function getErrstr(): string {
    return $this->errstr;
  }

  public function getErrfile(): string {
    return $this->errfile;
  }

  public function getErrline(): int {
    return $this->errline;
  }

  public function stopPropagation() {
    $this->stopped = true;
  }

  public function isStopped(): bool {
    return $this->stopped;
  }

}
