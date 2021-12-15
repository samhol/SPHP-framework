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

use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualUrlBuilder;

/**
 * The ManualReference class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Reference implements ManualURL {

  /**
   * Index page for both book and reference types
   */
  public const INDEX = 'index';

  protected PHPManualUrlBuilder $urlBuilder;
  private string $name;
  private string $description;

  /**
   * Constructor
   *
   * @param string $name
   * @param string $description
   * @param PHPManualUrlBuilder|null $urlBuilder
   */
  public function __construct(string $name, string $description, ?PHPManualUrlBuilder $urlBuilder = null) {
    if ($urlBuilder === null) {
      $urlBuilder = new PHPManualUrlBuilder();
    }
    $this->urlBuilder = $urlBuilder;
    $this->name = $name;
    $this->description = $description;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->urlBuilder);
  }

  /**
   * Cloner
   */
  public function __clone() {
    $this->urlBuilder = clone $this->urlBuilder;
  }

  /**
   * Return the name of the reference
   * 
   * @return string the name of the reference
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Return the description of the reference
   * 
   * @return string the description of the reference
   */
  public function getDescription(): string {
    return $this->description;
  }

  public function getLanguage(): string {
    return $this->urlBuilder->getLanguage();
  }

  public function getRootUrl(): string {
    return $this->urlBuilder->getRootUrl();
  }

  public function setLanguage(string $lang) {
    $this->urlBuilder->setLanguage($lang);
    return $this;
  }

  public function getApiname(): string {
    return $this->urlBuilder->getApiname();
  }

  public function getURL(): string {
    return $this->urlBuilder->createUrl('ref.%s.php', $this->getName());
  }

}
