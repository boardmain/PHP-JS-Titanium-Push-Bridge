PHP-JS-Titanium-Push-Bridge
===========================

Phalcon PHP RPC for titanium push with javascript client library


You can send push or Via HTTP Post Form

~~~
<!-- Demo Form Submit -->
<form action="http://WWW.YOUR.SERVER.IT/push/send" method="post">
<input type="text" value="YOUR_APP_API_KEY" name="app"/><br>
<textarea rows="4" name="messaggio" cols="20"></textarea>
<input type="submit" value="Invia">
</form>
~~~


or with JS CALL

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
