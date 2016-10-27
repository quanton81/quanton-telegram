define('BOT_TOKEN', '1111:aaaa');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

include_once 'librerie/LIB_http.php';

function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);

  $http_get = http_get($url, '');
  
  print "ERROR:\n";
  print_r($http_get['ERROR']);
  print "STATUS:\n";
  print_r($http_get['STATUS']);
  print "FILE:\n";
  print_r($http_get['FILE']);
  
}

apiRequest("sendMessage", array('chat_id' => '111', "text" => 'Hi I am a bot!'));
