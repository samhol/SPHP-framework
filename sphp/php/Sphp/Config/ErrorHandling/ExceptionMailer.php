<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

/**
 * Sends a thrown exception as a email
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExceptionMailer implements ExceptionListener {

  /**
   * @var string
   */
  private $sender;

  /**
   * @var string 
   */
  private $receiver;

  /**
   * Constructor
   * 
   * @param string $from optional senders email address 
   * @param string $to receivers email address
   */
  public function __construct(string $from, string $to) {
    $this->setSender($from)->setReceiver($to);
  }

  /**
   * Returns senders email address or null if not set
   * 
   * @return string|null senders email address or null if not set
   */
  public function getSender(): string {
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
   * @return $this for a fluent interface
   */
  public function setSender(string $sender) {
    $this->sender = $sender;
    return $this;
  }

  /**
   * Sets receivers email address
   * 
   * @param  string $receiver receivers email address
   * @return $this for a fluent interface
   */
  public function setReceiver(string $receiver) {
    $this->receiver = $receiver;
    return $this;
  }

  /**
   * 
   * @param  Throwable $t the throwable to mail
   * @return $this for a fluent interface
   */
  public function send(Throwable $t) {
    $mail = new Message();
    $mail->setFrom($this->getSender());
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

  public function onException(Throwable $e): void {
    $this->send($e);
  }

}
