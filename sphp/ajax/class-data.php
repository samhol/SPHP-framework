<?php

//declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../settings.php');
require_once ('../appConf.php');
$headers = new \Sphp\Network\Headers\Headers();
$headers->appendContentType('application/json; charset=UTF-8');
$headers->save();

use Sphp\Reflection\Parsers\ClassInfoToJson;

if (filter_has_var(INPUT_GET, 'class')) {
  $className = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING);
  $prop = filter_input(INPUT_GET, 'f', FILTER_SANITIZE_STRING);
  $params = filter_input(INPUT_GET, 'par',FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
  try {
    $errThrower = Sphp\Config\ErrorHandling\ErrorToExceptionThrower::getInstance();
    $errThrower->start();
    $ref = new ClassInfoToJson($className);
    echo $ref->getReflectionValue($prop, $params);
    $errThrower->stop();
  } catch (ReflectionException $ex) {
    $data['ERROR'] = "class";
    $data['ERROR_MESSAGE'] = $ex->getMessage();
  } catch (Throwable $ex) {
    $data['message'] = $ex->getMessage();
    $data['file'] = $ex->getFile();
    $data['line'] = $ex->getLine();
    echo json_encode($data, JSON_PRETTY_PRINT);
  }
}
