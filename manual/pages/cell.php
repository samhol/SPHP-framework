<pre>
  <?php
  print_r(array_map('str_getcsv', file('./manual/snippets/example.csv')));

  //print_r(str_getcsv("1,2,3,4//1,2,3,4"));
  $csv = new Sphp\Stdlib\Parsers\Csv();
  $filename = './sphp/php/tests/files/image.gif';
  $data = parse_ini_string('[a]
b= 45
?{}^=d
e='
          , true);
  var_dump($data);
  var_dump(Sphp\Stdlib\Filesystem::isAsciiFile($filename));
  $filename = './sphp/php/tests/files/x.gif';
  var_dump(Sphp\Stdlib\Filesystem::isAsciiFile($filename));
  $filename = './sphp/php/tests/files/valid.csv';
  var_dump(Sphp\Stdlib\Filesystem::isAsciiFile($filename), $csv->fileToArray($filename));
  ?>
</pre>