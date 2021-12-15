<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\Audio;

/**
 * Class AbstractMultimediaTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AudioTest extends TestCase {

  public function testConstructor(): Audio {
    $audio = new Audio();
    $this->assertSame('audio', $audio->getTagName());
    $this->assertFalse($audio->attributeExists('controls'));
    $this->assertFalse($audio->attributeExists('autoplay'));
    $this->assertFalse($audio->attributeExists('loop'));
    $this->assertFalse($audio->attributeExists('muted'));
    return $audio;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Audio $audio
   * @return Audio
   */
  public function testOutput(Audio $audio): Audio {
    $this->assertStringContainsString($audio->getIterator()->getHtml(), $audio->contentToString());
    $audio->autoplay();
    $fullTag = "<{$audio->getTagName()} {$audio->attributes()}>{$audio->contentToString()}</{$audio->getTagName()}>";
    $this->assertSame($fullTag, $audio->getHtml());
    return $audio;
  }

}
