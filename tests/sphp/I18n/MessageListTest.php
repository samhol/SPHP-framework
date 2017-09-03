<?php

namespace Sphp\I18n;

require_once 'GettextDataTrait.php';

use Sphp\I18n\Gettext\PluralGettextData;

class MessageListTests extends \PHPUnit\Framework\TestCase {

  use GettextDataTrait;

  /**
   * 
   * @return array
   */
  public function messages() {
    foreach (self::gettextIterator()->getPlurals() as $data) {
      $arr[] = new PluralMessage($data->getMessageId(), $data->getPluralId(), 2);
    }
    $arr[] = new Message('Could not write to log file: %s', 'file.txt');
    $arr[] = new Message('Please insert %s-%s characters', [3, 10]);
    return $arr;
  }

  /**
   */
  public function testInsert() {
    $pml = new PrioritizedMessageList();
    foreach ($this->messages() as $message) {
      $pml->insert($message);
      $this->assertTrue($pml->contains($message));
    }
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(PluralGettextData $data) {
    $m = new PluralMessage($data->getMessageId(), $data->getPluralId(), 0);
    $this->assertEquals($m->setItemCount(0)->translate(), $data->getPluralTranslation());
    $this->assertEquals($m->setItemCount(1)->translate(), $data->getTranslation());
    $this->assertEquals($m->setItemCount(2)->translate(), $data->getPluralTranslation());
    $this->assertEquals($m->isPlural(false)->translate(), $data->getTranslation());
    $this->assertEquals($m->isPlural()->translate(), $data->getPluralTranslation());
  }

}
