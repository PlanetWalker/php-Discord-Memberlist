<?php
require_once('user.php');
require_once(ROOTPATH . '/routes/lib/BruteForceBlock.php');

use ejfrancis\BruteForceBlock;

class LoginDelayExeption extends Exception {
    public function getDelay() {
      //error message
      $errorMsg = $this->getMessage();
      return $errorMsg;
    }
}

try {
    $BFBresponse = BruteForceBlock::getLoginStatus();
        switch ($BFBresponse['status']){
            case 'safe':
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $db = app_db(); 
                    $username = $db->CleanDBData($_POST['username']);
                    $password = $db->CleanDBData($_POST['password']);
                    $result = $db->query("SELECT `UserID`, `Username`, `Password`, `UserGroup` FROM `Accounts` WHERE `Username`= '$username';");
                    $row = $result->fetch_assoc();
                    if($result != false && mysqli_num_rows($result) != 0 && $password == $row['Password']) {
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        $_SESSION['user'] = new User($row['Username'], $row['Password'], $row['UserGroup']);
                        die(json_encode(array
		                (
			                'status'=>'succes',		
			                'message' => '',			
			                'code' => 'true',
		                )));
                    } else {
                        $BFBresponse = BruteForceBlock::addFailedLoginAttempt($username, GetRealUserIp());
                        die(json_encode(array(
			                'status'=>'failure',			
			                'message' => 'Incorrect password',
			                'code' => 'false',
		                )));
                    }
                } else
                die(json_encode(array(
			        'status'=>'failure',			
			        'message' => 'Incorrect inputs',
			        'code' => 'false',
		            )));

                break;
            case 'error':
                //error occured. get message
                $error_message = $BFBresponse['message'];
                throw new Exeption($error_message);
            case 'delay':
                //time delay required before next login
                $remaining_delay_in_seconds = $BFBresponse['message'];
                throw new LoginDelayExeption($remaining_delay_in_seconds);
            case 'captcha':
                die(json_encode(array(
			        'status'=>'failure',			
			        'message' => 'lockedout',
			        'code' => '',
		            )));
        }
} catch (LoginDelayExeption $e) {
    die(json_encode(array(
		'status'=>'failure',			
		'message' => 'delay',
		'code' => $e->getDelay(),
		)));
} catch (Exeption $e) {
    die(json_encode(array(
		'status'=>'failure',			
		'message' => 'error',
		'code' => $e->getTraceAsString(),
		)));
}

/**
 * Get real user ip
 *
 * Usage sample:
 * GetRealUserIp();
 * GetRealUserIp('ERROR',FILTER_FLAG_NO_RES_RANGE);
 *
 * @param string|null $default default return value if no valid ip found
 * @param int $filter_options filter options. default is FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
 *
 * @return string real user ip
 */

/*function GetRealUserIp(string $default = NULL, int $filter_options = 12582912): ?string
{
    $HTTP_X_FORWARDED_FOR = isset($_SERVER) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : getenv('HTTP_X_FORWARDED_FOR');
    $HTTP_CLIENT_IP = isset($_SERVER) ? $_SERVER["HTTP_CLIENT_IP"] : getenv('HTTP_CLIENT_IP');
    $HTTP_CF_CONNECTING_IP = isset($_SERVER) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : getenv('HTTP_CF_CONNECTING_IP');
    $REMOTE_ADDR = isset($_SERVER) ? $_SERVER["REMOTE_ADDR"] : getenv('REMOTE_ADDR');

    $all_ips = explode(",", "$HTTP_X_FORWARDED_FOR,$HTTP_CLIENT_IP,$HTTP_CF_CONNECTING_IP,$REMOTE_ADDR");
    foreach ($all_ips as $ip) {
        if ($ip = filter_var($ip, FILTER_VALIDATE_IP, $filter_options))
            break;
    }
    return $ip ?: $default;
}*/
function GetRealUserIp()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

?>