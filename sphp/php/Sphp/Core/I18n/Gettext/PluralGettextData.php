<?php

/**
 * PluralGettextData.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

/**
 * Implements a data object for plural gettext data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PluralGettextData extends GettextData {

  /**
   *
   * @var string
   */
  private $pluralMsgId;

  /**
   *
   * @var string
   */
  private $pluralTranslation;

  /**
   * 
   * @param string $id
   * @param string $msgString
   * @param string $pluralId
   * @param string $pluralTranslation
   * @param string|null $flags
   */
  public function __construct($id, $msgString, $pluralId, $pluralTranslation, $flags = null) {
    parent::__construct($id, $msgString, $flags);
    $this->pluralMsgId = $pluralId;
    $this->pluralTranslation = $pluralTranslation;
  }

  /**
   * 
   * @return string
   */
  public function getPluralId() {
    return $this->pluralMsgId;
  }

  /**
   * 
   * @return string
   */
  public function getPluralTranslation() {
    return $this->pluralTranslation;
  }

}
