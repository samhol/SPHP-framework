<?php

/**
 * ExceptionMailer.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

/**
 * Sends an exception as a email
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionMailer implements ExceptionListener {

  /**
   * @var string|null
   */
  private $sender;

  /**
   * @var string 
   */
  private $receiver;

  /**
   * Constructs a new instance
   * 
   * @param string $to receivers email address
   * @param string|null $from optional senders email address (null for none)
   */
  public function __construct(string $to, string $from = null) {
    $this->setSender($from)->setReceiver($to);
  }

  /**
   * Returns senders email address or null if not set
   * 
   * @return string|null senders email address or null if not set
   */
  public function getSender() {
    return $this->sender;
  }

  /**
   * Returns receivers email address
   * 
   * @return string receivers email address
   */
  public function getReceiver(): string {
    return $this->receiver;
  }

  /**
   * Sets senders email address
   * 
   * @param  string $sender optional senders email address (null for none)
   * @return self for a fluent interface
   */
  public function setSender(string $sender = null) {
    $this->sender = $sender;
    return $this;
  }

  /**
   * Checks if senders email address is set
   * 
   * @return boolean true if senders email address is set, otherwise false
   */
  public function hasSender(): bool {
    return $this->sender !== null;
  }

  /**
   * Sets receivers email address
   * 
   * @param  string $receiver receivers email address
   * @return self for a fluent interface
   */
  public function setReceiver(string $receiver) {
    $this->receiver = $receiver;
    return $this;
  }

  /**
   * 
   * @param  Throwable $t the throwable to mail
   * @return self for a fluent interface
   */
  public function send(Throwable $t) {
    $mail = new Message();
    if ($this->hasSender()) {
      $mail->setFrom($this->getSender());
    }
    $mail->addTo($this->getReceiver());
    $mail->setSubject(get_class($t));
    $mail->setBody($this->createMailBody($t));
    $mail->setEncoding('UTF-8');
    $transport = new Sendmail();
    $transport->send($mail);
    return $this;
  }

  /**
   * 
   * @param  Throwable $t the throwable to mail
   * @return string mail body as a string
   */
  protected function parseThrowable(Throwable $t): string {
    $output .= "Type: " . get_class($t) . "\n";
    $output = get_class($t) . ": " . $t->getMessage() . ", (code " . $t->getCode() . ")\n";
    $output .= "----------------------\n";
    $output .= "on line " . $t->getLine() . " of file '" . $t->getFile() . "'\n";
    $output .= "----------------------\n";
    $output .= "Trace:\n" . $t->getTraceAsString() . "\n";
    if ($t->getPrevious() !== null) {
      $output .= "----------------------\n";
      $output .= "Previous exception:\n" . $this->parseThrowable($t->getPrevious()) . "\n";
    }
    $output .= "----------------------\n";
    return $output;
  }

  /**
   * 
   * @param  Throwable $t the throwable to mail
   * @return string mail body as a string
   */
  protected function createMailBody(Throwable $t): string {
    $mailBody = "An exception was thrown:\n";
    $mailBody .= $this->parseThrowable($t);
    return $mailBody;
  }

  public function onException(Throwable $e) {
    $this->send($e);
  }

}
