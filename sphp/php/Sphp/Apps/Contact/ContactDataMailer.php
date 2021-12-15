<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact;

use Laminas\Mail\Transport\Sendmail;
use Laminas\Mail\Address;
use Laminas\Mail\AddressList;
use Laminas\Mail\Message;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Mime;
use Laminas\Mime\Part as MimePart;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Navigation\A;

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
   * @var string[]
   */
  private $receivers;

  /**
   * @var Sendmail 
   */
  private $mailer;

  /**
   * @var Address
   */
  private $from;

  /**
   * @var AddressList
   */
  private $to;

  /**
   * @var AddressList
   */
  private $replyTo;

  /**
   * Constructs a new instance
   * 
   * @param string $autoSender
   * @param string[] $receivers
   */
  public function __construct(iterable $autoSender = null, iterable $receivers = null) {
    $this->sender = $autoSender;
    $this->receivers = $receivers;
    $this->from;
    $this->to = new AddressList();
    $this->mailer = new Sendmail();
  }

  public function __destruct() {
    unset($this->mailer);
  }

  public function setFrom(string $email, string $name = null) {
    $this->from = new Address($email, $name);
    return $this;
  }

  public function addTo(string $email, string $name = null) {
    $this->to->add(new Address($email, $name));
    return $this;
  }

  public function addReplyTo(string $email, string $name = null) {
    if ($this->replyTo === null) {
      $this->replyTo = new AddressList();
    }
    $this->replyTo->add(new Address($email, $name));
    return $this;
  }

  protected function createMessage(): Message {
    $message = new Message();
    $message->setFrom($this->from);
    $message->setTo($this->to);
    if ($this->replyTo !== null) {
      $message->setReplyTo($this->replyTo);
    }
    $message->setEncoding('UTF-8');
    return $message;
  }

  /**
   * 
   * @param  DataObject $data
   * @return $this for a fluent interface
   */
  public function sendMessage(DataObject $data) {
    $message = $this->createMessage();
    if ($data->email !== null) {
      $message->setReplyTo(new Address($data->email, $data->name));
    }
    $message->setSubject('Yhteydenotto lomakkeen välityksellä')
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
   * @param  DataObject $data
   * @return $this for a fluent interface
   */
  public function replyTo(DataObject $data) {
    $this->getMessage()->setFrom($this->sender);
    $this->getMessage()->addTo($data->getReceiver());
    $this->getMessage()->setSubject("Thank you for your message");
    $this->getMessage()->setBody('I <strong>will get back to you as soon as possible</strong>');
    $this->getMessage()->setEncoding('UTF-8');
    $this->send();
    return $this;
  }

  protected function createMailBody(DataObject $data): MimeMessage {
    $body = new MimeMessage();
    $body->setParts([$this->createMailBodyText($data), $this->createMailBodyHtml($data)]);
    return $body;
  }

  /**
   * 
   * @param  DataObject $data
   * @return MimePart mail body as plain text
   */
  protected function createMailBodyText(DataObject $data): MimePart {
    $text = "Viestin lähettäjän yhteystiedot\n";
    //$text .= "\nHUOM: Vastaa aina asiakkaan sähköpostiin äläkä lomakkeeseen!!\n";

    $text .= " Nimi: {$data['name']}\n";
    $text .= " Sähköpostiosoite: {$data->email}\n";
    if ($data->phone !== null) {
      $text .= " Puhelinnumero:  {$data->phone}\n";
    }
    if ($data->message !== null) {
      $text .= "-----\n";
      $text .= "Viesti:\n\n  {$data->message}\n";
    }
    $mime = new MimePart($text);
    $mime->type = Mime::TYPE_TEXT;
    $mime->charset = 'utf-8';
    $mime->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
    return $mime;
  }

  /**
   * 
   * @param  DataObject $data
   * @return MimePart mail body as HTML
   */
  protected function createMailBodyHtml(DataObject $data): MimePart {
    $mailBody = '<html><body>';
    $mailBody .= "<h1>Viestin tiedot</h1>";
    $mailBody .= '<h2>Viestin lähettäjän yhteystiedot</h2>';
    $mailBody .= $this->personToHtml($data);
    if ($data->message !== null) {
      $mailBody .= '<h2>Viesti</h2>';
      $mailBody .= "<pre>$data->message</pre>";
    }
    $mailBody .= '</body></html>';
    $html = new MimePart($mailBody);
    $html->setType(Mime::TYPE_HTML);
    $html->setCharset('utf-8');
    $html->setEncoding(Mime::ENCODING_QUOTEDPRINTABLE);
    return $html;
  }

  /**
   * 
   * @param  DataObject $data
   * @return string personal data as HTML
   */
  protected function personToHtml(DataObject $data): string {
    $ul = new Ul;
    $ul->addCssClass('form-data');
    $ul->append("<strong>Nimi:</strong> $data->name");
    $emailLink = new A("mailto:$data->email", $data->email);
    $ul->append("<strong>Sähköpostiosoite:</strong>  $emailLink");
    if ($data->phone !== null) {
      $phoneLink = new A("tel:$data->phone", $data->phone);
      $ul->append("<strong>Puhelinnumero:</strong>  $phoneLink");
    }
    return $ul->getHtml();
  }

}
