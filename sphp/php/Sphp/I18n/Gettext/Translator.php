<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Gettext;

if (!defined('LC_MESSAGES')) {
  define('LC_MESSAGES', 6);
}

use Sphp\I18n\AbstractTranslator;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\Locale;

/**
 * Implements a natural language translator
 *
 * The underlying technology used in translation is PHP's gettext extension.
 *
 * **Links:**
 *
 * * {@link http://www.gnu.org/software/gettext/manual/}
 * * {@link http://www.gnu.org/software/gettext/manual/html_node/index.html}
 * * {@link http://php.net/manual/en/book.gettext.php}
 * * {@link http://php.net/manual/en/function.setlocale.php}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Translator extends AbstractTranslator {

  /**
   * the name (filename) of the used text domain
   *
   * @var string
   */
  private $domain;

  /**
   * the path of the translation file
   *
   * @var string
   */
  private $directory;

  /**
   * the charset of the translation file
   *
   * @var string
   */
  private $charset;

  /**
   * Constructor
   *
   * **IMPORTANT:**
   * The name of the `.mo` file must match the `$domain`. e.g the file path
   * (Finnish translations) should match `$directory/fi_FI/LC_MESSAGES/$domain.mo`
   * 
   * @param  string $domain the filename of the dictionary
   * @param  string $directory the locale path of the dictionary
   * @param  string $charset the character set of the dictionary
   * @throws InvalidArgumentException
   */
  public function __construct(string $domain = 'Sphp.Defaults', string $directory = 'sphp/locale', string $charset = null) {
    $this->directory = $directory;
    $this->setDomain($domain, $charset);
    $this->charset = $charset;
  }

  /**
   * Returns the name of the text domain
   *
   * @return string the name (filename) of the text domain
   */
  public function getDomain(): string {
    return $this->domain;
  }

  /**
   * Sets the name of the text domain
   *
   * @param  string $domain the name (filename) of the text domain
   * @param string $charset
   * @return $this for a fluent interface
   */
  public function setDomain(string $domain, string $charset = null) {
    $this->domain = $domain;
    DomainBinder::bindtextdomain($domain, $this->directory, $charset);
    return $this;
  }

  public function getDirectory(): string {
    return $this->directory;
  }

  public function getCharset(): string {
    return $this->charset;
  }

  public function setDirectory(string $directory = null) {
    $this->directory = $directory;
    return $this;
  }

  public function setCharset(string $charset = null) {
    $this->charset = $charset;
    return $this;
  }

  public function get(string $message): string {
    $lang = $this->getLang();
    $tempLc = Locale::getMessageLocale();
    if ($lang !== $tempLc) {
      Locale::setMessageLocale($lang);
    }
    $translation = dgettext($this->domain, $message);
    if ($lang !== $tempLc) {
      Locale::setMessageLocale($tempLc);
    }
    return $translation;
  }

  public function getPlural(string $msgid1, string $msgid2, int $n): string {
    $lang = $this->getLang();
    $tempLc = Locale::getMessageLocale();
    Locale::setMessageLocale($lang);
    $translation = dngettext($this->domain, $msgid1, $msgid2, $n);
    Locale::setMessageLocale($tempLc);
    return $translation;
  }

}
