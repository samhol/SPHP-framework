
<pre>
  <?php
  $date = new DateTimeImmutable('last monday');
  $start = $date->format('2018-09-10');
  echo $start;
  $query = <<<JSON
query {
  repository(owner: "samhol", name: "SPHP-framework") {
    ref(qualifiedName: "master") {
      target {
        ... on Commit {
          history(since: "{$start}T00:00:00Z" until:"{$start}T23:59:59Z") {
            pageInfo {
              hasNextPage
              endCursor
            }
            edges {
              node {
                url
                messageHeadline
                pushedDate
              }
            }
          }
        }
      }
    }
  }
}

JSON;
  $variables = '';



  $json = json_encode(['query' => $query, 'variables' => $variables]);

  $chObj = curl_init();
  curl_setopt($chObj, CURLOPT_URL, 'https://api.github.com/graphql');
  curl_setopt($chObj, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($chObj, CURLOPT_CUSTOMREQUEST, 'POST');
//curl_setopt($chObj, CURLOPT_HEADER, true);
  curl_setopt($chObj, CURLOPT_POSTFIELDS, $json);
  curl_setopt($chObj, CURLOPT_HTTPHEADER, [
      'User-Agent: PHP Script',
      'Content-Type: application/json;charset=utf-8',
      'Authorization: bearer 1569726f0d1efed0390c'
      //'Authorization: bearer a0461769551af53d17e8167dcaf9b9d6ed43ce93'
          ]
  );

  $response = curl_exec($chObj);
  curl_close($chObj);
  //var_dump($response);
  $arr = json_decode($response, true);
  foreach ($arr["data"]["repository"]["ref"]["target"]["history"]["edges"] as $node) {
    //var_dump($node["node"]);
    echo new Sphp\Html\Navigation\Hyperlink($node["node"]["url"], $node["node"]["messageHeadline"] . " at " . $node["node"]["pushedDate"]);
  }
  var_dump($arr);
  var_dump(isset($arr["data"]["repository"]["ref"]["target"]["his1tory"]["edges"]));
  ?>
</pre>
