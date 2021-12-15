<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\I18n;

use PHPUnit\Framework\TestCase;
use Sphp\I18n\Gettext;
use Sphp\I18n\Exceptions\TranslatorException;

class GettextTest extends TestCase {

  public function testConstructor(): void {
    $domain = 'sphp-datetime';
    $directory = './sphp/locale';
    $charset = 'UTF-8';
    $locales = ['fi-FI', 'fi_FI', 'Finnish_Finland.1252'];
    $translator = new Gettext($domain, $directory, $charset);
    $this->assertSame($charset, $translator->getCharset());
    $this->assertDirectoryExists($directory);
    $this->assertDirectoryExists($translator->getDirectory());
    $this->assertSame($domain, $translator->getDomain());
    //putenv('LC_ALL=en_US.utf-8');
    $translator->setLocale(...$locales);
    $this->assertSame($locales, $translator->getLocale());
    //  $translator->setLang('fi_FI.utf8');
    //print_r(\Sphp\Config\LocaleManager::listCurrentLocaleInformation());
    // $this->assertSame('viikko', $translator->get('week'));
    $this->assertSame('viikko', $translator->get('week'));
  }

  public function invalidDomainParameters(): array {
    $params = [];
    $params[] = ['foo', 'bar', null];
    $params[] = ['foo', './sp/e', null];
    return $params;
  }

  /**
   * @dataProvider invalidDomainParameters
   * 
   * @param string $domain
   * @param string|null $directory
   * @param string|null $charset
   * @return void
   */
  public function testConstructorFailure(string $domain, ?string $directory, ?string $charset): void {
    $this->expectException(TranslatorException::class);
    new Gettext($domain, $directory, $charset);
  }

  /**
   * @dataProvider invalidDomainParameters
   * 
   * @param string $domain
   * @param string|null $directory
   * @param string|null $charset
   * @return void
   */
  public function testSetDomainFailure(string $domain, ?string $directory, ?string $charset): void {
    $translator = new Gettext('sphp-filesystem', './sphp/locale', null);
    $this->expectException(TranslatorException::class);
    $translator->setDomain($domain, $directory, $charset);
  }

  public function testTranslationsUsingSystemLocales(): void {
    $domain = 'sphp-filesystem';
    $directory = './sphp/locale';
    $charset = 'UTF-8';
    $old = setlocale(\LC_ALL, '0');
    setlocale(\LC_ALL, 'fi-FI', 'fi_FI', 'Finnish_Finland.1252');
    $translator = new Gettext($domain, $directory, $charset);
    $this->assertSame('%d hakemisto', $translator->getPlural('%d directory', '%d directories', 1));
    $this->assertSame('%d hakemistoa', $translator->getPlural('%d directory', '%d directories', 2));
    $this->assertSame('sulje', $translator->get('close'));
    setlocale(\LC_ALL, $old);
  }

  public function testTranslationsUsingSpecificLocales(): void {
    $domain = 'sphp-filesystem';
    $directory = './sphp/locale';
    $charset = 'UTF-8';
    $locale = ['fi-FI', 'fi_FI', 'Finnish_Finland.1252'];
    $translator = new Gettext($domain, $directory, $charset);
    $translator->setLocale(...$locale);
    $this->assertSame('%d hakemisto', $translator->getPlural('%d directory', '%d directories', 1));
    $this->assertSame('%d hakemistoa', $translator->getPlural('%d directory', '%d directories', 2));
  }

  public function testTranslateArray(): void {
    $domain = 'sphp-datetime';
    $directory = './sphp/locale';
    $charset = 'UTF-8';
    $locale = 'Finnish_Finland.1252';
    $array = [];
    $array['mo'] = 'Monday';
    $array['sub'] = [7 => 'Sunday'];
    $expected = [];
    $expected['mo'] = 'maanantai';
    $expected['sub'] = [7 => 'sunnuntai'];
    $translator = new Gettext($domain, $directory);
    $charset1 = mb_internal_encoding();
    //var_dump($charset1);
    // var_dump($expected == $expecte1);
    // var_dump($expected,$translator->translateArray($array));
    // var_dump($expected == $translator->translateArray($array));
    $this->assertEquals($expected, $translator->translateArray($array));
  }

  public function testMagicCall(): void {
    $domain = 'sphp-filesystem';
    $directory = './sphp/locale';
    $translator = new Gettext($domain, $directory);
    $this->assertEquals('uusi', $translator('new'));
    $this->assertSame('%d hakemistoa', $translator('%d directory', '%d directories', 0));
    $this->assertSame('%d hakemisto', $translator('%d directory', '%d directories', 1));
    $this->assertSame('%d hakemistoa', $translator('%d directory', '%d directories', 2));
  }

  public function testVsprintf(): void {
    $domain = 'sphp-filesystem';
    $directory = './sphp/locale';
    $charset = 'UTF-8';
    $locale = 'Finnish_Finland.1252';
    $translator = new Gettext($domain, $directory);
    $this->assertEquals('uusi', $translator('new'));
    $this->assertSame('0 hakemistoa', $translator->vsprintfPlural('%d directory', '%d directories', 0, [0]));
    $this->assertSame('avaa tavua', $translator->vsprintfPlural('%s byte', '%s bytes', 0, ['open'], true));

    $this->assertSame("Nimetään uudelleen 'avaa' 'sulje':ksi", $translator->vsprintf("Renaming '%s' to '%s'", ['open', 'close'], true));
    $this->assertSame("Nimetään uudelleen 'avaa' 'foo':ksi", $translator->vsprintf("Renaming '%s' to '%s'", ['open', 'foo', 'foo'], true));
    $this->expectException(TranslatorException::class);

    $this->assertSame("Nimetään uudelleen 'avaa' 'foo':ksi", $translator->vsprintf("Renaming '%s' to '%s'", ['foo'], true));
  }

}
