<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\Data;

use IteratorAggregate;
use Traversable;
use Sphp\Stdlib\Datastructures\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * The ViewData class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FileBrowser implements IteratorAggregate {

  private array $languages;
  private array $formData;
  private array $files;

  /**
   * @var PoFile[]
   */
  private array $objects;

  public function __construct(string $path) {
    $this->languages = [];
    $this->files = [];
    $this->files['po'] = [];
    $this->files['pot'] = [];
    $this->files['mo'] = [];
    $dir_iterator = new RecursiveDirectoryIterator($path);
    $iterator = new RecursiveIteratorIterator($dir_iterator);
    foreach ($iterator as $info) {
      if ($info->isFile()) {
        $this->parseFileType($info);
      }
    }
  }

  public function __destruct() {
    unset($this->objects);
  }

  private function parsePoLanguage(PoFile $file): void {
    $lang = $file->getLang();
    if (!array_key_exists($lang, $this->languages)) {
      $this->languages[$lang] = 1;
    } else {
      $this->languages[$lang] += 1;
    }
  }

  protected function parseFileType(SplFileInfo $info): void {
    $ext = $info->getExtension();
    if ($ext === 'po') {
      $poFile = new PoFile($info);
      $this->parsePoLanguage($poFile);
      $this->formData[$poFile->getLang()][$poFile->getHash()] = $poFile->getFileInfo()->getFilename();
      $this->objects[$poFile->getHash()] = $poFile;
      //$this->poFiles[$poFile->getHash()] = $poFile;
      $this->files['po'][$poFile->getHash()] = $poFile;
    } else if ($ext === 'pot') {
      $poFile = new PotFile($info);
      $this->formData['templates'][$poFile->getHash()] = $poFile->getFileInfo()->getFilename();
      $this->objects[$poFile->getHash()] = $poFile;
      //$this->potFiles[$poFile->getHash()] = $poFile;
      $this->files['pot'][$poFile->getHash()] = $poFile;
    } else if ($ext === 'mo') {
      $poFile = new MoFile($info);
      //$this->moFiles[$poFile->getHash()] = $poFile;
      $this->files['mo'][$poFile->getHash()] = $poFile;
    }
  }

  public function isValidHash(string $hash): bool {
    return array_key_exists($hash, $this->objects);
  }

  public function getFile(string $hash): GettextFile {
    if (!$this->isValidHash($hash)) {
      throw new \Exception('No PO files found using hash ' . $hash);
    }
    return $this->objects[$hash];
  }

  public function getFormData(): array {
    return $this->formData;
  }

  public function getIterator(): Traversable {
    return new Collection($this->objects);
  }

  public function getLanguages(): array {
    return array_keys($this->languages);
  }

  public function getPoFiles(?string $lang = null): array {
    if ($lang !== null) {
      $out = [];
      foreach ($this->files['po'] as $key => $file) {
        if ($file->getLang() === $lang) {
          $out[$key] = $file;
        }
      }
    } else {
      $out = $this->files['po'];
    }
    return $out;
  }

  public function getPotFiles(): array {
    return $this->files['pot'];
  }

  public function getMoFiles(): array {
    return $this->files['mo'];
  }

}
