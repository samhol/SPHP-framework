<pre>
<?php
$query = <<<'JSON'
{
  repositoryOwner(login: "samhol") {
    repositories(first: 5) {
      edges {
        node {
          nameWithOwner
          pullRequests(last: 100, states: OPEN) {
            edges {
              node {
                title
                url
                author {
                  login
                }
                labels(first: 20) {
                  edges {
                    node {
                      name
                    }
                  }
                }
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
curl_setopt($chObj, CURLOPT_HEADER, true);
curl_setopt($chObj, CURLOPT_POSTFIELDS, $json);
curl_setopt($chObj, CURLOPT_HTTPHEADER,
     array(
            'User-Agent: PHP Script',
            'Content-Type: application/json;charset=utf-8',
            'Authorization: bearer 4f846dc314f34a5b153f0bd03c2bb0bcae55da00'
        )
    ); 

$response = curl_exec($chObj);
var_dump($response);
var_dump(json_decode($response, true));
?>
</pre>
