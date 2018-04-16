<?php ?>
<pre>
</pre>
<?php

try {
  $e = new Exception('total foo');

  function a(bool $a, float $k = 4, Sphp\Html\Lists\Ol $ol = null) {
    echo $a;
    //a('me hard', 2, 'tmes');
    throw new \InvalidArgumentException();
  }

  a(false, 7, new Sphp\Html\Lists\Ol(), null, ['a', false, 7, new Sphp\Html\Lists\Ol(), null]);
} catch (\Exception $ex) {
  $e = new \Sphp\Exceptions\Exception($ex->getMessage(), $ex->getCode(), $ex);
  $exceptionth = new Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder();
  
  echo $exceptionth->showPreviousException()->showTrace()->showInitialFile()->buildCallout($e);
}
?>

