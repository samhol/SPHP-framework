<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\AbstractItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Html\Navigation\A;
use Sphp\Reflection\Utils\PHPWord;
use Sphp\Reflection\Utils\PHPWords;

/**
 * Description of ControlStructureLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LanguageReferenceLinker extends AbstractItemLinker {

  private PHPWord $word;
  private PHPManualURLs $urls;

  /**
   * Constructor
   * 
   * @param string $name
   * @param PHPManualURLs|null $urlGen
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(string $name, ?PHPManualURLs $urlGen = null, ?HyperlinkFactory $hyperlinkFactory = null) {
    if (!PHPWords::fullCollection()->containsWord($name)) {
      throw new NonDocumentedFeatureException("Word $name is not documented");
    }
    if ($urlGen === null) {
      $urlGen = new PHPManualURLs();
    }
    $this->urls = $urlGen;
    $this->word = PHPWords::fullCollection()->getWord($name);
    parent::__construct($hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('php-api', 'php-manual');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->urls, $this->word);
  }

  public function __invoke(?string $linkText = null): A {
    return $this->toHyperlink($linkText);
  }

  public function getDefaultContent(): string {
    return $this->word->getName();
  }

  public function getDefaultTitle(): string {
    $out = "Documentation of PHP $this->word";
    if ($this->word->isControlStructure()) {
      $out = "Documentation of PHP control structure: '$this->word'";
    } else if ($this->word->isPrimitiveTypeName()) {
      $out = "Documentation of PHP type name $this->word";
    } else if ($this->word->isPseudoTypeName()) {
      $out = "Documentation of PHP pseudo type name $this->word";
    } else if ($this->word->isMagicMethodName()) {
      $out = "Documentation of magic PHP method $this->word";
    } else if ($this->word->isMagicConstantName()) {
      $out = "Documentation of magic PHP constant $this->word";
    } else if ($this->word->isVariable()) {
      $out = "Documentation of pre defined PHP variable $this->word";
    } else if ($this->word->isKeyword()) {
      $out = "Documentation of PHP keyword $this->word";
    }
    return $out;
  }

  public function getUrl(): string {
    return $this->urls->getLanguageReferenceUrl($this->word->getName());
  }

}
