<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Gettext;

/**
 * Implements a data object for gettext data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
