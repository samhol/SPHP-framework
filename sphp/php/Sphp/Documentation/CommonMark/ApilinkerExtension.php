<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\CommonMark;

use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use Sphp\Documentation\Linkers\PHP\PhpApiLinker;

/**
 * Class ApilinkerExtension
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ApilinkerExtension implements ExtensionInterface {

  /**
   * @var BasicPhpApiLinker 
   */
  private PhpApiLinker $linker;

  /**
   * Constructor
   * 
   * @param PhpApiLinker|null $apiLinker 
   */
  public function __construct(?PhpApiLinker $apiLinker = null) {
    if ($apiLinker === null) {
      $apiLinker = new PhpApiLinker();
    }
    $this->linker = $apiLinker;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->linker);
  }

  public function register(EnvironmentBuilderInterface $environment): void {
    $environment
            ->addInlineParser(new ApiLinkParser($this->linker), 20)
            ->addRenderer(ApiLink::class, new ApiLinkRenderer(), 0)
    ;
  }

}
