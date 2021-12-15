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

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\ConstantPathBuilder;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
/**
 * Class ConstantTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConstantPathBuilderTest extends TestCase {

  public function constants(): array {
    $output = [];
    $output[] = ['MB_OVERLOAD_MAIL', 'mbstring.constants.php#constant.mb-overload-mail'];
    $output[] = ['LOG_CONS', 'network.constants.php#constant.log-cons'];
    $output[] = ['DNS_A', 'network.constants.php#constant.dns-a'];
    $output[] = ['STREAM_BUFFER_NONE', 'stream.constants.php#constant.stream-buffer-none'];
    $output[] = ['PSFS_PASS_ON', 'stream.constants.php#constant.psfs-pass-on'];
    $output[] = ['CREDITS_FULLPAGE', 'info.constants.php#constant.credits-fullpage'];
    $output[] = ['IMG_JPEG', 'image.constants.php#constant.img-jpeg'];
    $output[] = ['PHP_VERSION', 'reserved.constants.php#constant.php-version'];

    $output[] = ['DATE_RFC3339_EXTENDED', 'class.datetimeinterface.php#datetime.constants.rfc3339_extended'];
    $output[] = ['SUNFUNCS_RET_TIMESTAMP', 'datetime.constants.php#constant.sunfuncs-ret-timestamp'];
    $output[] = ['SUNFUNCS_RET_STRING', 'datetime.constants.php#constant.sunfuncs-ret-string'];
    $output[] = ['SUNFUNCS_RET_DOUBLE', 'datetime.constants.php#constant.sunfuncs-ret-double'];

    $output[] = ['E_WARNING', 'errorfunc.constants.php#errorfunc.constants.errorlevels.e-warning'];

    $output[] = ['FILE_APPEND', 'filesystem.constants.php#constant.file-append'];
    $output[] = ['ARRAY_FILTER_USE_BOTH', 'array.constants.php#constant.array-filter-use-both'];
    $output[] = ['SORT_ASC', 'array.constants.php#constant.sort-asc'];
    $output[] = ['CASE_UPPER', 'array.constants.php#constant.case-upper'];
    $output[] = ['INI_SCANNER_RAW', 'info.constants.php#constant.ini-scanner-raw'];
    $output[] = ['PHP_URL_HOST', 'url.constants.php#constant.php-url-host'];
    $output[] = ['PHP_QUERY_RFC1738', 'url.constants.php#constant.php-query-rfc1738'];
    $output[] = ['PASSWORD_DEFAULT', 'password.constants.php#constant.password-default'];
    $output[] = ['STR_PAD_BOTH', 'string.constants.php#constant.str-pad-both'];
    $output[] = ['PHP_ROUND_HALF_UP', 'math.constants.php#constant.php-round-half-up'];
    $output[] = ['IMAGETYPE_GIF', 'image.constants.php#constant.imagetype-gif'];
    $output[] = ['CONNECTION_NORMAL', 'misc.constants.php#constant.connection-normal'];
    $output[] = ['SCANDIR_SORT_NONE', 'dir.constants.php#constant.scandir-sort-none'];

    $output[] = ['HASH_HMAC', 'hash.constants.php#constant.hash-hmac'];

    $output[] = ['INPUT_ENV', 'filter.constants.php#constant.input-env'];

    $output[] = ['Parle\INTERNAL_UTF32', 'parle.constants.php#parle.constant.internal-utf32'];

    $output[] = ['__LINE__', 'language.constants.magic.php#constant.line'];
    $output[] = ['__FILE__', 'language.constants.magic.php#constant.file'];
    $output[] = ['__DIR__', 'language.constants.magic.php#constant.dir'];
    $output[] = ['__FUNCTION__', 'language.constants.magic.php#constant.function'];
    $output[] = ['__CLASS__', 'language.constants.magic.php#constant.class'];
    $output[] = ['__TRAIT__', 'language.constants.magic.php#constant.trait'];
    $output[] = ['__METHOD__', 'language.constants.magic.php#constant.method'];
    $output[] = ['__NAMESPACE__', 'language.constants.magic.php#constant.namespace'];

    $output[] = ['T_ABSTRACT', 'tokens.php'];

    $output[] = ['SID', 'session.constants.php#constant.sid'];

    return $output;
  }

  /**
   * @dataProvider constants
   * 
   * @param  string $constant
   * @param  string $expectedPath
   * @return void
   */
  public function testCriticalConstants(string $constant, string $expectedPath): void {
    $this->assertEquals($expectedPath, ConstantPathBuilder::instance()($constant));
  }

  /**
   * @return void
   */
  public function testFailureOnUserDefined(): void {
    $this->expectException(NonDocumentedFeatureException::class);
    ConstantPathBuilder::instance()('\A\B\C_1');
  }

}
