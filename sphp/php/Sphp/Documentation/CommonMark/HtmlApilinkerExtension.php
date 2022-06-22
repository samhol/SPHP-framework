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
use Sphp\Documentation\Linkers\Html\HtmlApiLinker;

/**
 * Class ApilinkerExtension
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HtmlApilinkerExtension implements ExtensionInterface {

  private HtmlApiLinker $linker;

  /**
   * Constructor
   * 
   * @param HtmlApiLinker|null $apiLinker 
   */
  public function __construct(?HtmlApiLinker $apiLinker = null) {
    if ($apiLinker === null) {
      $apiLinker = new HtmlApiLinker();
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
            ->addInlineParser(new HtmlApiLinkParser($this->linker), 20)
            ->addRenderer(ApiLink::class, new ApiLinkRenderer(), 0)
    ;
  }

}
