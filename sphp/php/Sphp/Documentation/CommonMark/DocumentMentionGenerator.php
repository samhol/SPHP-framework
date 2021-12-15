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

use League\CommonMark\Extension\Mention\Generator\MentionGeneratorInterface;
use League\CommonMark\Extension\Mention\Mention;
use League\CommonMark\Node\Inline\AbstractInline;
use Sphp\Documentation\Linkers\PHP\PhpApiLinker;

/**
 * The DocumentMentionGenerator class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DocumentMentionGenerator implements MentionGeneratorInterface {

  private PhpApiLinker $documentLinker;

  public function __construct(PhpApiLinker $linker) {
    $this->documentLinker = $linker;
  }

  public function __destruct() {
    unset($this->documentLinker);
  }

  public function generateMention(Mention $mention): ?AbstractInline {

    try {
      $linker = $this->documentLinker->build($mention->getIdentifier());
    } catch (\Exception $ex) {
      return null;
    }

    // Change the label.
    $mention->setLabel($linker->getDefaultContent());
    // Use the path to their profile as the URL, typecasting to a string in case the service returns
    // a __toString object; otherwise you will need to figure out a way to extract the string URL
    // from the service.
    $mention->setUrl($linker->getUrl());

    return $mention;
  }

}
