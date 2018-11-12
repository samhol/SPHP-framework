<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
define('OAUTH2_CLIENT_ID', '1569726f0d1efed0390c');
define('OAUTH2_CLIENT_SECRET', '5663277114feeea84fd853ae6189bfdca516b985');
$authorizeURL = 'https://github.com/login/oauth/authorize';
$tokenURL = 'https://github.com/login/oauth/access_token';
$apiURLBase = 'https://api.github.com/';
session_start();
// Start the login process by sending the user to Github's authorization page
if(get('action') == 'login') {
  // Generate a random hash and store in the session for security
  $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
  unset($_SESSION['access_token']);
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
    'scope' => 'user',
    'state' => $_SESSION['state']
  );
  // Redirect the user to Github's authorization page
  header('Location: ' . $authorizeURL . '?' . http_build_query($params));
  die();
}
// When Github redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code')) {
  // Verify the state matches our stored state
  if(!get('state') || $_SESSION['state'] != get('state')) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    die();
  }
  // Exchange the auth code for a token
  $token = apiRequest($tokenURL, array(
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'],
    'state' => $_SESSION['state'],
    'code' => get('code')
  ));
  $_SESSION['access_token'] = $token->access_token;
  header('Location: ' . $_SERVER['PHP_SELF']);
}
if(session('access_token')) {
  $user = apiRequest($apiURLBase . 'user');
  echo '<h3>Logged In</h3>';
  echo '<h4>' . $user->name . '</h4>';
  echo '<pre>';
  print_r($user);
  echo '</pre>';
} else {
  echo '<h3>Not logged in</h3>';
  echo '<p><a href="?action=login">Log In</a></p>';
}
function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $headers[] = 'Accept: application/json';
  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  return json_decode($response);
}
function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}
function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
?>

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
