<?php

/*
 * The MIT License
 *
 * Copyright 2018 Sami Holck <sami.holck@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Sphp\Sessions;

/**
 * Implements a session handler for file system storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FileSessionHandler extends AbstractSessionHandler {

  private $savePath;

  public function open($savePath, $sessionName) {
    $this->savePath = $savePath;
    if (!is_dir($this->savePath)) {
      mkdir($this->savePath, 0777);
    }

    return true;
  }

  public function close() {
    return true;
  }

  public function read($id) {
    return (string) @file_get_contents("$this->savePath/sess_$id");
  }

  public function write($id, $data) {
    return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
  }

  public function destroy($id) {
    $file = "$this->savePath/sess_$id";
    if (file_exists($file)) {
      unlink($file);
    }

    return true;
  }

  public function gc($maxlifetime) {
    foreach (glob("$this->savePath/sess_*") as $file) {
      if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
        unlink($file);
      }
    }

    return true;
  }

}
