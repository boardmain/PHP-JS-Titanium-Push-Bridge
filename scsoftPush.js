/*!
 * SCSOFT Titanium Appcelerator Push Bridge
 * http://www.scsoft.it
 *
 *
 * Copyright 2014 Samuele Coppedè
 * Released under the MIT license
 *
 */

(function (jQuery){
	var jQ = jQuery;
	var serverURL = "http://WWW.YOURSERVERURL.IT/ajax/send";
		
	var scsoftPush = function (params) {
        return new Library(params);
    };
    
	var Library = function(){
		/*
		 * Default Values
		 */
		this.appKey = null;
		this.userAcs = 'admin';
		this.passAcs = 'password';
		this.toIds= 'everyone';
		this.channel ='notify';
		this.message = '';
		this.title = 'Notifica';
		this.vibrate = true;
		this.badge = null;
		this.sound = false;
		this.onResult = null;
		return this;
	};
	
	
	Library.prototype.send = function(messaggio){
		if(messaggio!=''){
			this.message = messaggio;
		}
		try {
			jQ.ajax({
			  dataType: 'json',
			  type: "POST",
			  url: serverURL,
			  data: { 
				  app: this.appKey, 
				  useracs: this.userAcs,
				  toids: this.toIds,
				  channel :this.channel,
				  messaggio : this.message,
				  titolo: this.title,
				  vibrate: this.vibrate,
				  badge:this.badge,
				  sound:this.sound
			  }
			})
			.done(this.onResult)
			.fail(this.onResult);
		}catch(err){
			alert(err);
		}
		
	}
		
	Library.prototype.dump = function(){
		alert(JSON.stringify(this));
	};
	
	
	if(!window.scsoftPush) {
        window.scsoftPush = new Library();
    }
	
})(jQuery);