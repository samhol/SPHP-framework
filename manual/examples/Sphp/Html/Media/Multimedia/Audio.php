<?php

namespace Sphp\Html\Media\Multimedia;

(new Audio("https://upload.wikimedia.org/wikipedia/commons/0/0a/Pl-Bytom.ogg"))
        ->showControls(true)
        ->printHtml();
