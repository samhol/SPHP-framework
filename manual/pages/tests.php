<?php

namespace Sphp\Manual;
var_dump (new \stdClass() == 2);
md(<<<MD
```ini
[XDebug]
zend_extension = "c:\xampp\php\ext\php_xdebug-2.5.5-7.1-vc14.dll"
xdebug.remote_autostart = 1
xdebug.profiler_append = 0
xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = "c:\xampp\tmp"
;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_host = "127.0.0.1"
xdebug.remote_log="c:\xampp\tmp\xdebug.txt"
xdebug.remote_port = 9000
xdebug.trace_output_dir = "c:\xampp\tmp"
; 3600 (1 hour), 36000 = 10h
xdebug.remote_cookie_expire_time = 36000
```
        
gerg
MD
);


codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>
<div class="expanded small alert button-group">
  <a class="button alert">Harder</a>
  <a class="button success">Better</a>
  <a class="button">Faster</a>
  <a class="button">Stronger</a>
</div>

<div class="input-group">
  <span class="input-group-label">$</span>
  <input class="input-group-field" type="number">
  <div class="input-group-button">
    <input type="reset" class="button" value="Reset">
    <input type="submit" class="button" value="Submit">
  </div>
</div>

<div class="input-group">
  <input id="ebra" class="input-group-field" type="number">
  <select class="input-group-field" rows="4"><option>foo</option></select>
  <div class="input-group-button">
    <input type="submit" class="button" value="Submit">
  </div>
  <span class="input-group-label">$</span>
    <input type="submit" class="button" value="Submit">
  <span class="input-group-label">$</span>
  <label for="ebra" class="input-group-label">$</label><div class="input-group-button">
    <input type="submit" class="button" value="Submit">
  </div>
</div>

<?php
$group = new \Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
$group->append(new \Sphp\Html\Forms\Inputs\NumberInput('foo'))->setPlaceholder('insert foo');
$group->append(new \Sphp\Html\Forms\Inputs\EmailInput('foomail'))->setPlaceholder('insert foo');
$group->appendInput('email','foomail')->setPlaceholder('insert foo');
$group->appendButton('Submit', 'foo-submit');
echo $group;
md(<<<MD

```
zend_extension = "c:\xampp\php\ext\php_xdebug-2.5.5-7.1-vc14.dll"
xdebug.remote_autostart = 1
xdebug.profiler_append = 0
xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = "c:\xampp\tmp"
;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_host = "127.0.0.1"
xdebug.remote_log="c:\xampp\tmp\xdebug.txt"
xdebug.remote_port = 9000
xdebug.trace_output_dir = "c:\xampp\tmp"
; 3600 (1 hour), 36000 = 10h
xdebug.remote_cookie_expire_time = 36000
```
        
gerg
MD
);
