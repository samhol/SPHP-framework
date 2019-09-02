<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('/home/int48291/public_html/playground/manual/settings.php');
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRING);
echo "foo $name $type $version";