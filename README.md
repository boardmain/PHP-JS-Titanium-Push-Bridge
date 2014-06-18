PHP-JS-Titanium-Push-Bridge
===========================

Phalcon PHP RPC for titanium push with javascript client library

SERVER SECTION
==============

The index.php
is the RPC For calling the appcelerator CLOUD Api
for install it PHALCON PHP Framewrok is required

[Phalcon PHP Framework](http://phalconphp.com/)

Available Post Params with default values if not provided:


~~~
$request->getPost("app")  ?: NULL;
$request->getPost("useracs")  ?: 'admin';
$request->getPost("passacs")  ?: 'password';
$request->getPost("toids")  ?:'everyone';
$request->getPost("channel")  ?:'notify';
$request->getPost("messaggio") ?: NULL;
$request->getPost("titolo")   ?: 'Notifica';
$request->getPost('vibrate') ?: true;
$request->getPost('badge') ?: null;
$request->getPost('sound') ?: false;
~~~



***

CLIENT SECTION
==============



You can send push  Via HTTP Post Form

~~~
<!-- Demo Form Submit -->
<form action="http://WWW.YOUR.SERVER.IT/push/send" method="post">
<input type="text" value="YOUR_APP_API_KEY" name="app"/><br>
<textarea rows="4" name="messaggio" cols="20"></textarea>
<input type="submit" value="Invia">
</form>
~~~


or with JS CALL

You MUST Provide the you Server RPC Url in the file scsoftPush.hs

~~~
 var serverURL = "http://WWW.YOURSERVERURL.IT/ajax/send";
~~~

~~~
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="scsoftPush.js"></script>

<script type="text/javascript">
//DEMO JS SUBMIT
scsoftPush.appKey = 'YOUR_APP_API_KEY';
scsoftPush.onResult = function(res){
	if(res.result){
		alert('push inviata');
	}else{
		alert('errore invio push');
	}
};
scsoftPush.send('Test');
</script>
~~~
