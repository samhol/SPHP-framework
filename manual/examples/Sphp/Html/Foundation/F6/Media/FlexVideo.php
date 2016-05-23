<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Core\Grid as Grid;
use Sphp\Html\media\YoutubePlayer as YoutubePlayer;

$flex[] = (new FlexVideo("CdMs7eqMvNg", FlexVideo::YOUTUBE))
		->setLazy();
$flex[] = (new FlexVideo())
		->setPlayer(new YoutubePlayer("WwrpLgWyAjU"))
		->setLazy();
$flex[] = (new FlexVideo())
		->setSource("X8E1wkenjEk", FlexVideo::YOUTUBE)
		->setLazy();

$grid = (new Grid($flex))
		->printHtml();
?>