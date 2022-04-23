<?php
// Print errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);

//--->get app url > start

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $ssl = 'https';
}
else {
  $ssl = 'http';
}
 
$app_url = ($ssl  )
          . "://".$_SERVER['HTTP_HOST']
          //. $_SERVER["SERVER_NAME"]
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

//--->get app url > end

header("Access-Control-Allow-Origin: *");

//app url
define("APPURL", $app_url);
define("AJAX_URL", $app_url.'/api');

//absolute path to root directory of app
define("ROOTPATH", str_replace("\\", "/",  dirname(__FILE__) ));



//libs
include_once ROOTPATH. '/routes/lib/AltoRouter.php'; 
include_once ROOTPATH. '/routes/lib/SimpleDBClass.php'; 



$router = new AltoRouter();
$base_path = trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
$router->setBasePath($base_path ? "/".$base_path : "");


//--->rountes
include_once ROOTPATH. '/routes/app-route.php';


 
// match current request url
$match = $router->match();
 
// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) 
{    
  call_user_func_array( $match['target'], array_values($match['params'] )); 
} 
else 
{
 
  // no route was matched
 
  $app_url_asset = APPURL;
  http_response_code(404);
  header("HTTP/1.1 404 Not Found", TRUE);
  die('
  <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
  <html><head>
  <title>404 Not Found</title>
  </head><body>
  <h1>Not Found</h1>
  <p>The requested URL '. htmlspecialchars($_SERVER['REQUEST_URI']) .' was not found on this server.</p>
  </body></html>
  ');

  //die(APPURL .' > 404 page');
}
 
$app_url = ($ssl  )
          . "://".$_SERVER['HTTP_HOST']
          //. $_SERVER["SERVER_NAME"]
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");

//--->get app url > end

?>