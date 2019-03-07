<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Description of FoundationSettings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FoundationSettings {

  /**
   * @var self 
   */
  private static $instance;

  /**
   * Foundation screen size names
   *
   * @var string[]
   */
  private $sizes = ['small', 'medium', 'large', 'xlarge', 'xxlarge'];

  /**
   * @var int 
   */
  private $gridMax;

  /**
   * @var int 
   */
  private $blockGridMax;

  /**
   * Constructor
   * 
   * @param array $sizes
   * @param int $gridMax
   * @param type $blockGridMax
   */
  public function __construct(array $sizes = null, int $gridMax = 12, int $blockGridMax = 8) {
    if ($sizes !== null) {
      $this->sizes = $sizes;
    }
    $this->gridMax = $gridMax;
    $this->blockGridMax = $blockGridMax;
    $this->setGridSizes($gridMax);
  }

  private function setGridSizes(int $gridMax) {
    $this->cellSizes = range(1, $gridMax);
    $this->cellSizes['auto'] = 'auto';
    $this->cellSizes['shrink'] = 'shrink';
  }

  public function isValidCellSize($size): bool {
    return in_array($size, $this->cellSizes);
  }

  /**
   * Checks whether the given screen size exists
   * 
   * @param  string $size screen size name
   * @return boolean true if the given size exists
   */
  public function sizeExists(string $size): bool {
    return in_array($size, $this->sizes);
  }

  /**
   * 
   * @return string[]
   */
  public function getScreenSizes(): array {
    return $this->sizes;
  }

  /**
   * Returns next larger screen size
   * 
   * @param  string $currentSize
   * @return string next larger screen size
   * @throws InvalidArgumentException if given current size does not exist
   * @throws OutOfRangeException the size given is already the smallest
   */
  public function getNextSize(string $currentSize): string {
    $sizes = $this->toArray();
    $key = array_search($currentSize, $sizes);
    if ($key === false) {
      throw new InvalidArgumentException("Screensize '$currentSize' does not exist");
    } else if ($key === count($sizes) - 1) {
      throw new OutOfRangeException("Screensize '$currentSize' has no next larger size");
    } else {
      return $sizes[$key + 1];
    }
  }

  /**
   * Returns previous smaller screen size
   * 
   * @param  string $currentSize
   * @return string previous smaller screen size
   * @throws InvalidArgumentException if given current size does not exist
   * @throws OutOfRangeException the size given is already the smallest
   */
  public function getPreviousSize(string $currentSize): string {
    $sizes = $this->toArray();
    $key = array_search($currentSize, $sizes);
    if ($key === false) {
      throw new InvalidArgumentException("Screensize '$currentSize' does not exist");
    } else if ($key === 0) {
      throw new OutOfRangeException("Screensize '$currentSize' has no previous smaller size");
    } else {
      return $sizes[$key - 1];
    }
  }

  public static function setDefault(array $sizes = null, int $gridMax = 12, $blockGridMax = 8): FoundationSettings {
    if (empty($sizes)) {
      $sizes = ['small', 'medium', 'large', 'xlarge', 'xxlarge'];
    }
    self::$instance = new static($sizes, $gridMax, $blockGridMax);
    return self::$instance;
  }

  public static function default(): FoundationSettings {
    if (self::$instance === null) {
      static::setDefault();
    }
    return self::$instance;
  }

}
