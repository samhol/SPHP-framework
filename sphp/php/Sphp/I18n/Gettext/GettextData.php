<?php

/**
 * GettextData.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Gettext;

/**
 * Implements a data object for gettext data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GettextData {

  /**
   * @var string
   */
  private $msgid;

  /**
   * @var string
   */
  private $translation;

  /**
   * @var string|null
   */
  private $flags;

  /**
   * 
   * @param string $msgid
   * @param string $translation
   * @param string|null $flags
   */
  public function __construct(string $msgid, string $translation, string $flags = null) {
    $this->msgid = $msgid;
    $this->translation = $translation;
    $this->flags = $flags;
  }

  public function getMessageId(): string {
    return $this->msgid;
  }

  public function getTranslation(): string {
    return $this->translation;
  }

  public function getFlags(): string {
    return $this->flags;
  }
  
  public function __toString(): string {
    return $this->translation;
  }

}
