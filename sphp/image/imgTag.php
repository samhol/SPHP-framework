<?php

/**
 * imgTag.php (UTF-8)
 *
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * This file is part of SPH framework.
 *
 * SPH framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SPH framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SPH framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace Sphp\Html;
include_once("../settings.php");

use Sphp\Html\ImgTag as Img;

$src = filter_input(\INPUT_GET, 'src', \FILTER_SANITIZE_SPECIAL_CHARS);
$width = filter_input(\INPUT_GET, 'width', \FILTER_SANITIZE_NUMBER_INT);
$height = filter_input(\INPUT_GET, 'height', \FILTER_SANITIZE_NUMBER_INT);

Img::scaleToFit($src, $width, $height)->printHtml();