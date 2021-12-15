<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual\Books;

use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Class Book
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Book extends Reference {

  /**
   * intro  page for both book type
   */
  public const INTRO = 'intro';

  /**
   * setup page for both book type
   */
  public const SETUP = 'setup';

  /**
   * installation page for both book type
   */
  public const INSTALLATION = 'installation';

  /**
   * configuration page for both book type
   */
  public const CONFIGURATION = 'configuration';

  /**
   * resources page for both book type
   */
  public const RESOURCES = 'resources';

  /**
   * constants page for both book type
   */
  public const CONSTANTS = 'constants';

  private static array $paths = [
      self::INDEX => 'book.%s.php',
      self::INTRO => 'intro.%s.php',
      self::SETUP => '%s.setup.php',
      self::INSTALLATION => '%s.installation.php',
      self::CONFIGURATION => '%s.configuration.php',
      self::RESOURCES => '%s.resources.php',
      self::CONSTANTS => '%s.constants.php'];

  public function getURL(string $page = self::INDEX): string {
    if (!array_key_exists($page, self::$paths)) {
      throw new NonDocumentedFeatureException($this->getName() . " does not have the $page documentation");
    }
    return $this->urlBuilder->createUrl(self::$paths[$page], $this->getName());
  }

}
