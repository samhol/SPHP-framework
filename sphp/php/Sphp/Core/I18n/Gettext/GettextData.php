<?php

/**
 * GettextData.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;
use Sphp\Data\Arrayable;
/**
 * Description of PoData
 *
 * @author Sami
 */
class GettextData implements Arrayable {

  /**
   *
   * @var string
   */
  private $msgid;

  /**
   *
   * @var string
   */
  private $translation;

  /**
   *
   * @var string|null
   */
  private $flags;

  /**
   * 
   * @param string $msgid
   * @param string $translation
   * @param string|null $flags
   */
  public function __construct($msgid, $translation, $flags = null) {
    $this->msgid = $msgid;
    $this->translation = $translation;
    $this->flags = $flags;
  }

  public function getMessageId() {
    return $this->msgid;
  }

  public function getTranslation() {
    return $this->translation;
  }

  public function getFlags() {
    return $this->flags;
  }

  public function toArray() {   
    return get_object_vars($this);
  }

}
