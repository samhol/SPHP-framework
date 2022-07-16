<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n;

use Sphp\Config\LocaleManager;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use Sphp\I18n\Exceptions\TranslatorException;

/**
 * Implements a natural language translator
 *
 * The underlying technology used in translation is PHP's gettext extension.
 *
 * **Links:**
 *
 * * {@link http://www.gnu.org/software/gettext/manual/ GNU gettext manual}
 * * {@link https://www.php.net/manual/en/book.gettext.php PHP gettext manual} 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Gettext implements Translator {

  /**
   * the name (filename) of the used text domain
   */
  private string $domain;

  /**
   * the path of the translation file
   */
  private string $directory;

  /**
   * the charset of the translation file
   */
  private string $charset;

  /**
   * the charset of the translation file
   *
   * @var string[]
   */
  private array $locales;

  /**
   * Constructor
   *
   * **IMPORTANT:**
   * The name of the `.mo` file must match the `$domain`. e.g the file path
   * (Finnish translations) should match `$directory/fi_FI/LC_MESSAGES/$domain.mo`
   * 
   * @param  string $domain the domain
   * @param  string|null $directory the locale path of the dictionary
   * @param  string|null $charset the code set. If null, the current set encoding is used
   * @throws TranslatorException if invalid domain parameters provided
   */
  public function __construct(string $domain, ?string $directory, ?string $charset = null) {
    $this->setDomain($domain, $directory, $charset);
    $this->locales = [];
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
   * @param  string $domain the domain
   * @param  string|null $directory the locale path of the dictionary
   * @param  string|null $charset the code set. If null, the current set encoding is used
   * @return $this for a fluent interface
   * @throws TranslatorException if invalid domain parameters provided
   */
  public function setDomain(string $domain, ?string $directory = null, ?string $charset = null) {
    $fullpath = bindtextdomain($domain, (string) $directory);
    if ($fullpath === false) {
      throw new TranslatorException('Invalid domain parameters provided');
    }
    if ($charset !== null) {
      $this->charset = $charset;
    }
    if (!isset($this->charset)) {
      $this->charset = mb_internal_encoding();
    }
    bind_textdomain_codeset($domain, $this->charset);
    $this->domain = $domain;
    $this->directory = $fullpath;
    return $this;
  }

  public function getDirectory(): string {
    return $this->directory;
  }

  public function getCharset(): string {
    return $this->charset;
  }

  public function get(string $message): string {
    if ($this->hasLocales()) {
      $localeManager = new LocaleManager();
      $localeManager->setLocale(\LC_ALL, ...$this->getLocale());
    }
    $translation = dgettext($this->domain, $message);
    if ($this->hasLocales()) {
      $localeManager->restoreLocales(\LC_ALL);
    }
    return $translation;
  }

  public function getPlural(string $msgid1, string $msgid2, int $n): string {
    if ($this->hasLocales()) {
      $localeManager = new LocaleManager();
      $localeManager->setLocale(\LC_ALL, ...$this->getLocale());
    }
    $translation = dngettext($this->domain, $msgid1, $msgid2, $n);
    if ($this->hasLocales()) {
      $localeManager->restoreLocales(\LC_ALL);
    }
    return $translation;
  }

  public function getLocale(): array {
    return $this->locales;
  }

  public function hasLocales(): bool {
    return count($this->locales) > 0;
  }

  public function setLocale(string ... $lang) {
    $this->locales = $lang;
    return $this;
  }

  public function translateArray(array $messages): array {
    $output = [];
    foreach ($messages as $index => $value) {
      if (is_array($value)) {
        $output[$index] = $this->translateArray($value);
      } else if (is_string($value)) {
        $output[$index] = $this->get($value);
      }
    }
    return $output;
  }

  public function vsprintf(string $message, array $args, bool $translateArgs = false): string {
    return $this->format($this->get($message), $args, $translateArgs);
  }

  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, array $args, bool $translateArgs = false): string {
    return $this->format($this->getPlural($msgid1, $msgid2, $n), $args, $translateArgs);
  }

  /**
   * 
   * @param  string $message
   * @param  array $args
   * @param  bool $translateArgs
   * @return string
   * @throws TranslatorException if invalid number of arguments is presented
   */
  protected function format(string $message, array $args, bool $translateArgs = false): string {
    $thrower = ErrorToExceptionThrower::getInstance(TranslatorException::class);
    $thrower->start();
    if ($translateArgs) {
      $args = $this->translateArray($args);
    }
    $out = vsprintf($message, $args);
    $thrower->stop();
    return $out;
  }

  /**
   * Executes the dictionary for the given parameters
   * 
   * @param  string $text
   * @param  string|null $msgid2
   * @param  int|null $n
   * @return string
   */
  public function __invoke(string $text, ?string $msgid2 = null, ?int $n = null): string {
    if ($msgid2 !== null && $n !== null) {
      $out = $this->getPlural($text, $msgid2, $n);
    } else {
      $out = $this->get($text);
    }
    return $out;
  }

}
