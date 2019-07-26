<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest;

use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\MVC\MembershipRequest\Views\Views;

/**
 * Description of ContactDataMailer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContactDataMailer {

  /**
   * @var string 
   */
  private $sender;

  /**
   * @var string 
   */
  private $receiver;

  /**
   * @var Sendmail 
   */
  private $mailer;

  /**
   * Constructs a new instance
   * 
   * @param string $autoSender
   * @param string $receiver
   */
  public function __construct(string $autoSender, string $receiver) {
    $this->sender = $autoSender;
    $this->receiver = $receiver;
    $this->mailer = new Sendmail();
  }

  public function __destruct() {
    unset($this->mailer);
  }

  /**
   * 
   * @param  RequestData $data
   * @return $this for a fluent interface
   */
  public function sendMessage(RequestData $data) {
    $message = new Message();
    $message->setFrom($this->sender)
            ->addTo($this->receiver)
            ->setSubject('Raision veneseuran jäsenhakemus')
            ->setBody($this->createMailBody($data));
    $contentTypeHeader = $message->getHeaders()->get('Content-Type');
    $contentTypeHeader->setType('multipart/alternative');
    if (!$message->isValid()) {
      throw new InvalidArgumentException('Invalid contact data');
    }
    $this->mailer->send($message);
    return $this;
  }

  /**
   * 
   * @param  RequestData $data
   * @return $this for a fluent interface
   */
  public function replyTo(RequestData $data) {
    $this->getMessage()->setFrom($this->sender);
    $this->getMessage()->addTo($data->getReceiver());
    $this->getMessage()->setSubject("Thank you for your message");
    $this->getMessage()->setBody('I <strong>will get back to you as soon as possible</strong>');
    $this->getMessage()->setEncoding('UTF-8');
    $this->send();
    return $this;
  }

  protected function createMailBody(RequestData $data): MimeMessage {
    $body = new MimeMessage();
    $body->setParts([$this->createMailBodyText($data), $this->createMailBodyHtml($data)]);
    return $body;
  }

  /**
   * 
   * @param  RequestData $data
   * @return MimePart mail body as plain text
   */
  protected function createMailBodyText(RequestData $data): MimePart {
    $text = "RAISION VENESEURAN JÄSENHAKEMUS\n";
    $text .= "-----\n";
    $text .= "HAKIJAN TIEDOT:\n\n";

    $text .= "Nimi: {$data->getFname()} {$data->getLname()}\n";
    $dob = $data->getDateOfBirth();
    if ($dob instanceof \DateTimeInterface) {
      $age = $dob->diff(new \DateTime('now'));
      $text .= "Syntymäaika: " . $dob->format('j.n.Y');
      if ($age->y < 18) {
        $text .= "Juniori-jäsen: {$age->y}-vuotias\n";
      }
    } else {
      $text .= "Syntymäaika: ei annettu (Oletuksena aikuinen)\n";
    }
    $text .= "Osoite:\n";
    $text .= "\t{$data->getStreet()}\n";
    $text .= "\t{$data->getZipcode()}\n";
    $text .= "\t{$data->getCity()}\n";
    $text .= "<strong>Sähköpostiosoite:</strong>  {$data->getEmail()}\n";
    if ($data->getPhone() !== null) {
      $text .= "<strong>Puhelinnumero:</strong>  {$data->getPhone()}\n";
    }
    if ($data->getAdditionalInformation() !== null) {
      $text .= "<strong>Lisätietoja:</strong>  {$data->getAdditionalInformation()}\n";
    }
    $mime = new MimePart($text);
    $mime->type = Mime::TYPE_TEXT;
    $mime->charset = 'utf-8';
    $mime->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
    return $mime;
  }

  /**
   * 
   * @param  RequestData $data
   * @return MimePart mail body as HTML
   */
  protected function createMailBodyHtml(RequestData $data): MimePart {
    $mailBody = '<html><body>';
    $views = new Views();
    $mailBody .= "<h1>Raision veneseuran jäsenhakemus</h1>";
    $mailBody .= '<strong style="text-transform:underline;">HAKIJAN TIEDOT:</strong>';
    $mailBody .= $views->personToHtml($data);
    $mailBody .= '</body></html>';
    $html = new MimePart($mailBody);
    $html->type = Mime::TYPE_HTML;
    $html->charset = 'utf-8';
    $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
    return $html;
  }

}
