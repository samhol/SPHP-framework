
<pre>
<?php

/*
  [NOTE BY danbrown AT php DOT net: The array_diff_assoc_recursive function is a
  combination of efforts from previous notes deleted.
  Contributors included (Michael Johnson), (jochem AT iamjochem DAWT com),
  (sc1n AT yahoo DOT com), and (anders DOT carlsson AT mds DOT mdh DOT se).]
 */

function arrayRecursiveDiff($aArray1, $aArray2) {
  $aReturn = array();

  foreach ($aArray1 as $mKey => $mValue) {
    if (array_key_exists($mKey, $aArray2)) {
      if (is_array($mValue)) {
        $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
        if (count($aRecursiveDiff)) {
          $aReturn[$mKey] = $aRecursiveDiff;
        }
      } else {
        if ($mValue !== $aArray2[$mKey]) {
          $aReturn[$mKey] = $mValue;
        }
      }
    } else {
      $aReturn[$mKey] = $mValue;
    }
  }

  return $aReturn;
}

$a1 = Array
    (
    "0" => Array
        (
        "file" => "newhotfolder.gif",
        "path" => "images/newhotfolder.gif",
        "type" => "gif",
        "size" => "1074",
        "md5" => "123812asdkbqw98eqw80hasdas234234"
    ),
    "1" => Array
        (
        "file" => "image.gif",
        "path" => "images/attachtypes/image.gif",
        "type" => "gif",
        "size" => "625",
        "[md5]" => "7bbb66e191688a86b6f42a03bd412a6b"
    ),
    "2" => Array
        (
        "file" => "header.gif",
        "path" => "images/attachtypes/header.gif",
        "type" => "gif",
        "size" => "625",
        "md5" => "71291239asskf9320234kasjd8239393"
    )
);
$a2 = Array
    (
    "0" => Array
        (
        "file" => "newhotfolder.gif",
        "path" => "images/newhotfolder.gif",
        "type" => "gif",
        "size" => "1074",
        "md5" => "8375h5910423aadbef67189c6b687ff51c"
    ),
    "1" => Array
        (
        "file" => "image.gif",
        "path" => "images/attachtypes/image.gif",
        "type" => "gif",
        "size" => "625",
        "[md5]" => "7bbb66e191688a86b6f42a03bd412a6b"
    ),
    "2" => Array
        (
        "file" => "header.gif",
        "path" => "images/attachtypes/footer.gif",
        "type" => "gif",
        "size" => "625",
        "md5" => "1223819asndnasdn2213123nasd921"
    )
);

var_dump(arrayRecursiveDiff($a1, $a2));
print_r(arrayRecursiveDiff(
                [1, [[1, new \stdClass], 3, 2], 7], [1, [[1, new \stdClass, new \stdClass], 2, 3]]));
$fmt = new \MessageFormatter("en_US", "{0,number,integer} monkeys on {1,number,integer} trees make {2,number} monkeys per tree");
echo $fmt->format(array(4560, 123, 4560 / 123));
$fmt = new \MessageFormatter("de", "{0,number,integer} Affen auf {1,number,integer} Bäumen sind {2,number} Affen pro Baum");
echo $fmt->format(array(4560, 123, 4560 / 123));
 ?>
</pre>