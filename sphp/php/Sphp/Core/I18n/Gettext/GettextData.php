<?php

/**
 * GettextData.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

/**
 * Implements a data object for gettext data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GettextData {

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

}
