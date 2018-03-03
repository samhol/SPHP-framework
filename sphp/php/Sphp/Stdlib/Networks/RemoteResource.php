<?php

/**
 * RemoteResource.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Networks;

/**
 * Description of RemoteResource
 *
 * @author samih
 */
abstract class RemoteResource {

  /**
   * Checks whether the URL exists or not
   *
   * @return boolean true if the URL exists and false otherwise
   */
  public static function exists($url): bool {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
      //if request was ok, check response code
      $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

      if ($statusCode == 200) {
        $ret = true;
      }
    }
    curl_close($curl);
    return $ret;
  }

  /**
   * Returns the Mime type of the resource pointed by the given URL
   *
   * @param  string|URL $url the pointing to the resource
   * @return string the Mime type of the content pointed by the given URL
   */
  public static function getMimeType($url): string {
    if ($url instanceof URL) {
      $url = $url->__toString();
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_exec($ch);
    //curl_close($ch);
    $mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);
    return $mime;
  }

}
