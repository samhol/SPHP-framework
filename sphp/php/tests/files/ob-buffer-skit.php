<?php

declare(strict_types=1);

ob_start();
ob_start();
echo 'foo';
$content .= ob_get_clean();
