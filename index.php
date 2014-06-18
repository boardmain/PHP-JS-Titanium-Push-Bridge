<?php
use Phalcon\Mvc\Micro,
    Phalcon\Http\Response,
    Phalcon\Http\Request;

$app = new Micro();


$app->get('/', function() {
	echo "Push Gateway SCSOFT";
});


$app->post('/ajax/send', function() use ($app) {
	$response = new Response();
	$response->setHeader("Access-Control-Allow-Origin", $_SERVER['HTTP_ORIGIN']);
	$response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
	$response->setHeader("Access-Control-Max-Age", '1000');
	$response->setHeader("Access-Control-Allow-Headers", 'Content-Type, Authorization, X-Requested-With, X-PINGOTHER');
	$response->setJsonContent(array('result'=>doCall()));
	return $response;
});

$app->post('/send', function() use ($app) {
    	if(doCall()){
    		echo 'Push Inviata';
    	}else{
    		echo 'Errore invio Push';
    	}  
});
	

function doCall(){
	$request = new Request();
	$key        = $request->getPost("app")  ?: NULL;
	$username   = $request->getPost("useracs")  ?: 'admin';
	$password   = $request->getPost("passacs")  ?: 'password';
	$to_ids     = $request->getPost("toids")  ?:'everyone';
	$channel    = $request->getPost("channel")  ?:'notify';
	$message    = $request->getPost("messaggio") ?: NULL;
	$title      = $request->getPost("titolo")   ?: 'Notifica';
	$vibrate 	= $request->getPost('vibrate') ?: true;
	$badge 		= $request->getPost('badge') ?: null;
	$sound 		= $request->getPost('sound') ?: false;
	//$tmp_fname  = 'cookie.txt';
	$tmp_fname = tempnam("/tmp", "Cookie");
	
	$payload = new stdClass();
	$payload -> alert = $message;
	$payload -> title = $title;
	$payload -> badge = $badge;
	$payload -> vibrate = $vibrate;
	$payload -> sound = $sound;
	
	$json = json_encode($payload);
	
	if (!is_null($key) && !is_null($username) && !is_null($password) && !is_null($channel) && !is_null($message) && !is_null($title)){
		/*** PUSH NOTIFICATION ***********************************/
		$post_array = array('login' => $username, 'password' => $password);
	
		/*** INIT CURL *******************************************/
		$curlObj    = curl_init();
		$c_opt      = array(CURLOPT_URL => 'https://api.cloud.appcelerator.com/v1/users/login.json?key='.$key,
				CURLOPT_COOKIEJAR => $tmp_fname,
				CURLOPT_COOKIEFILE => $tmp_fname,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS  =>  "login=".$username."&password=".$password,
				CURLOPT_FOLLOWLOCATION  =>  false,
				CURLOPT_TIMEOUT => 60);
	
		/*** LOGIN **********************************************/
		curl_setopt_array($curlObj, $c_opt);
		$session = curl_exec($curlObj);
	
		/*** SEND PUSH ******************************************/
		$c_opt[CURLOPT_URL]         = "https://api.cloud.appcelerator.com/v1/push_notification/notify.json?key=".$key;
		$c_opt[CURLOPT_POSTFIELDS]  = "channel=".$channel."&payload=".$json."&to_ids=".$to_ids;
	
		curl_setopt_array($curlObj, $c_opt);
		$session = curl_exec($curlObj);
	
		/*** THE END ********************************************/
		curl_close($curlObj);
	
		return true;
	}else{
		return false;
		
	}
	
}

$app->handle();