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

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML track tag
 *
 *  This component specifies text tracks for {@link AbstractMediaTag} media 
 *  components. It is used to specify subtitles, caption files or other files 
 *  containing text, that should be visible when the media is playing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_track.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-track-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Track extends EmptyTag implements MultimediaSource {

  /**
   * Constructor
   *
   * @param  string $src the URL of the media file
   * @link   https://www.w3schools.com/tags/att_track_src.asp src attribute
   */
  public function __construct(string $src) {
    parent::__construct('track');
    $this->attributes()->protect('src', $src);
  }

  /**
   * Sets or unsets the track as default component
   * 
   * When a track is set as default, it specifies that the track is to be 
   * enabled if the user's preferences do not indicate that another track 
   * would be more appropriate.
   * 
   * **Note:** There must not be more than one {@link self} component with a 
   * default attribute per {@link AbstractMediaTag} component.
   *
   * @param  bool $default true if the track is default, otherwise false
   * @return $this for a fluent interface
   */
  public function setDefault(bool $default = true) {
    return $this->setAttribute('default', (bool) $default);
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @return bool true if the track is default, otherwise false
   */
  public function isDefault(): bool {
    return $this->attributeExists('default');
  }

  /**
   * Returns the URL of the track file
   * 
   * @return string the URL of the track file
   * @link   https://www.w3schools.com/tags/att_track_src.asp src attribute
   */
  public function getSrc(): string {
    return (string) $this->getAttribute('src');
  }

  /**
   * Sets the kind of text track
   *
   *  **Attribute Values:**
   * 
   * * `captions`:	The track defines translation of dialogue and sound effects (suitable for deaf users)
   * * `chapters`:	The track defines chapter titles (suitable for navigating the media resource)
   * * `descriptions`:	The track defines a textual description of the video content (suitable for blind users)
   * * `metadata`:	The track defines content used by scripts. Not visible for the user
   * * `subtitles`:	The track defines subtitles, used to display subtitles in a video
   * 
   * @param  string $kind specifies the kind of text track
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_track_kind.asp kind attribute
   */
  public function setKind(string $kind) {
    return $this->setAttribute('kind', $kind);
  }

  /**
   * Returns the kind of text track
   *
   *  **Returned Values:**
   * 
   * * `captions`:	The track defines translation of dialogue and sound effects (suitable for deaf users)
   * * `chapters`:	The track defines chapter titles (suitable for navigating the media resource)
   * * `descriptions`:	The track defines a textual description of the video content (suitable for blind users)
   * * `metadata`:	The track defines content used by scripts. Not visible for the user
   * * `subtitles`:	The track defines subtitles, used to display subtitles in a video
   *
   * @return string the kind of text track
   * @link   https://www.w3schools.com/tags/att_track_kind.asp kind attribute
   */
  public function getKind() {
    return $this->getAttribute('kind');
  }

  /**
   * Sets the language of the track text data
   *
   * **Important:** This is required if the  kind is "subtitles".
   * 
   * @param  string $srclang the language of the track text data
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   * @link   https://www.w3schools.com/tags/ref_language_codes.asp HTML Language Code Reference
   */
  public function setSrcLang($srclang) {
    return $this->setAttribute('srclang', $srclang);
  }

  /**
   * Returns the language of the track text data
   * 
   * @return string the language of the track text data
   * @link   https://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   * @link   https://www.w3schools.com/tags/ref_language_codes.asp HTML Language Code Reference
   */
  public function getSrcLang() {
    return $this->getAttribute('srclang');
  }

  /**
   * Sets the label of the track text data
   *
   * **Important:** This is required if the  kind is "subtitles".
   * 
   * @param  string $label the label of the track text data
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_track_label.asp label attribute
   */
  public function setLabel($label) {
    return $this->setAttribute('label', $label);
  }

  /**
   * Returns the label of the track text data
   * 
   * @return string the label of the track text data
   * @link   https://www.w3schools.com/tags/att_track_label.asp label attribute
   */
  public function getLabel() {
    return $this->getAttribute('label');
  }

}
