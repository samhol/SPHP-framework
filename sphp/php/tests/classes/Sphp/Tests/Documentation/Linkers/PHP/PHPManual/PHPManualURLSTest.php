<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualURLs;
use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;
use Sphp\Tests\Documentation\Linkers\PHP\URLGenerators\AbstractPHPApiUrlGeneratorTest;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualUrlBuilder;

/**
 * Class PHPManualURLSTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPManualURLSTest extends AbstractPHPApiUrlGeneratorTest {

  use \Sphp\Tests\Documentation\Linkers\PHP\PHPManual\ManualURLTestTrait;

  public function createManualURL(string $lang = 'en'): ManualURL {
    return $this->createUrlGen($lang);
  }

  public function createUrlGen(string $lang = 'en', string $apiName = 'PHP Manual'): PHPApiUrlGenerator {
    return new PHPManualURLs(new PHPManualUrlBuilder($lang, $apiName));
  }

  /**
   * @return void
   */
  public function testConstructor() {
    $emptyBuilder = new PHPManualUrlBuilder();
    $emptyGen = new PHPManualURLs();
    $this->assertSame($emptyBuilder->getLanguage(), $emptyGen->getLanguage());
    $this->assertSame($emptyBuilder->getApiname(), $emptyGen->getApiname());
    $urlGen = new PHPManualURLs(new PHPManualUrlBuilder('fr', 'france'));
    $this->assertSame('fr', $urlGen->getLanguage());
    $this->assertSame('france', $urlGen->getApiname());
  }

  public function classMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'class.reflectionclass.php'];
    $map[] = ['UI\Area', 'class.ui-area.php'];
    return $map;
  }

  public function classPropertyMap(): array {
    $map = [];
    $map[] = [\ReflectionClass::class, 'name', 'class.reflectionclass.php#reflectionclass.props.name'];
    $map[] = ['UI\Area', 'prop', 'class.ui-area.php#ui-area.props.prop'];
    return $map;
  }

  public function classMethodMap(): array {
    $map = [];
    $map[] = [\ReflectionParameter::class, '__clone', 'reflectionparameter.clone.php'];
    $map[] = [\ReflectionClass::class, '__clone', 'reflectionclass.clone.php'];
    $map[] = [\ReflectionClass::class, 'getName', 'reflectionclass.getname.php'];
    $map[] = ['UI\Area', 'onMouse', 'ui-area.onmouse.php'];
    $map[] = ['UI\Controls\Picker', '__construct', 'ui-controls-picker.construct.php'];
    return $map;
  }

  public function classConstantMap(): array {
    $map = [];
    $map[] = [\ReflectionClass ::class, 'IS_IMPLICIT_ABSTRACT', 'class.reflectionclass.php#reflectionclass.constants.is-implicit-abstract'];
    $map[] = ['UI\Area', 'Super', 'class.ui-area.php#ui-area.constants.super'];
    $map[] = [\Phar::class, 'CURRENT_AS_PATHNAME', 'class.filesystemiterator.php#filesystemiterator.constants.current-as-pathname'];
    return $map;
  }

  public function functionMap(): array {
    $map = [];
    $map[] = ['abs', 'function.abs.php'];
    $map[] = ['ctype_print', 'function.ctype-print.php'];
    return $map;
  }

  public function testGetExtensionUrl(): array {
    $gen = new PHPManualURLs();
    // print_r(get_loaded_extensions());
    foreach (get_loaded_extensions() as $extName) {
      // $gen->getExtensionUrl($extName);
      if (!\Sphp\Documentation\Linkers\PHP\PHPManual\Books\ExtensionDataManager::instance()->isReference($extName)) {
        //echo "\nEXT: $extName";
        $this->expectException(NonDocumentedFeatureException::class);
        $gen->getExtensionUrl($extName);
      } else {
        $book = $gen->getExtensionUrl($extName);
      }
    }
  }

  public function constantMap(): array {
    $output = [];
    $output[] = ['__LINE__', 'language.constants.magic.php#constant.line'];
    $output[] = ['LOG_CONS', 'network.constants.php#constant.log-cons'];
    $output[] = ['DNS_A', 'network.constants.php#constant.dns-a'];
    $output[] = ['STREAM_BUFFER_NONE', 'stream.constants.php#constant.stream-buffer-none'];
    $output[] = ['CREDITS_FULLPAGE', 'info.constants.php#constant.credits-fullpage'];
    $output[] = ['IMG_JPEG', 'image.constants.php#constant.img-jpeg'];
    $output[] = ['PHP_VERSION', 'reserved.constants.php#constant.php-version'];
    $output[] = ['DATE_RFC3339_EXTENDED', 'class.datetimeinterface.php#datetime.constants.rfc3339_extended'];
    $output[] = ['E_WARNING', 'errorfunc.constants.php#errorfunc.constants.errorlevels.e-warning'];
    return $output;
  }

  public function namespaceMap(): array {
    $output = [];
    $output[] = ['\\Ui', 'book.ui.php'];
    return $output;
  }

}
