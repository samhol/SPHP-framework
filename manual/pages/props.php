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
curl_setopt($chObj, CURLOPT_VERBOSE, true);
curl_setopt($chObj, CURLOPT_POSTFIELDS, $json);
curl_setopt($chObj, CURLOPT_HTTPHEADER,
     array(
            'User-Agent: PHP Script',
            'Content-Type: application/json;charset=utf-8',
            'Authorization: bearer 025f7b743d206a76c67c479a2ab0673982ae0227'
        )
    ); 

$response = curl_exec($chObj);
echo json_encode($response);

?>
</pre>
