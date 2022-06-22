<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Network\URL;
use Sphp\Html\Media\Multimedia\Exceptions\VideoPlayerException;

/**
 * Implements an embeddable Youtube Video palyer component
 * 
 * **Requirements:**
 * The user's browser must support the HTML5 `postMessage` feature. Most modern 
 * browsers support `postMessage`, though Internet Explorer 7 does not support it.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class YoutubePlayer extends AbstractVideoPlayer {

  /**
   * Constructor
   *
   * @param string $videoId the id of the YouTube video or playlist
   * @param boolean $isPlaylist whether the videoid is a playlist or a single video
   */
  public function __construct(string $videoId, bool $isPlaylist = false) {
    if ($isPlaylist) {
      $url = new URL('https://www.youtube.com/embed/');
      $url->getQuery()
              ->setParameter('listType', 'playlist')
              ->setParameter('list', $videoId);
    } else {
      $url = new URL('https://www.youtube.com/embed/' . $videoId);
    }
    parent::__construct($url);
  }

  public function displayControls(bool $visible = true) {
    $this->setOption('controls', (int) $visible);
    return $this;
  }

  public function autoplay(bool $autoplay = true) {
    $this->setOption('autoplay', (int) $autoplay);
    return $this;
  }

  public function mute(bool $mute = true) {
    $this->setOption('mute', (int) $mute);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->setOption('loop', (int) $loop);
    return $this;
  }

  /**
   * Set the visibility of the player controls
   * 
   * * `0`: The player controls are always visible.
   * * `1`: The player controls hides automatically when the video plays.
   * * `2` (default): If the player has 16:9 or 4:3 ratio, same as `1`, otherwise same as `0`.
   * 
   * @param  int $autohide the value of the autohide parameter
   * @return $this for a fluent interface
   * @throws VideoPlayerException
   */
  public function autohide(int $autohide = 2) {
    if ($autohide < 0 || $autohide > 2) {
      throw new VideoPlayerException("Invalid autohide option ($autohide) provided");
    }
    $this->setOption('autohide', $autohide);
    return $this;
  }

  /**
   * Set the time when the video should start and/or stop
   * 
   * @param  int|null $start the start time measured from the beginning of the video
   * @param  int|null $end the end time measured from the beginning of the video 
   * @return $this for a fluent interface
   */
  public function setTimeInterval(?int $start, ?int $end = null) {
    if ($start < 0 || $end < 0 || ($end !== null && $end < $start)) {
      throw new VideoPlayerException("Invalid time interval ($start, $end) given");
    }
    $this->setOption('start', $start);
    $this->setOption('end', $end);
    return $this;
  }

}
