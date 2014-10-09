<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/videoChat.css');
$cs->registerCssFile($baseUrl . '/style/css/default/viewAdvisers.css');
?>

<script src='http://static.opentok.com/webrtc/v2.2/js/opentok.min.js'></script>
<script type="text/javascript">
	// Initialize API key, session, and token...
	// Think of a session as a room, and a token as the key to get in to the room
	// Sessions and tokens are generated on your server and passed down to the client
	var apiKey = "44929562";
	var sessionId = "1_MX40NDkyOTU2Mn5-U3VuIEF1ZyAxMCAxODozMzo1NyBQRFQgMjAxNH4wLjQxNzA1MjAzfn4";
	var token = "T1==cGFydG5lcl9pZD00NDkyOTU2MiZzaWc9YTAxN2JjZmY3MDIwY2M0ZmQ3YTMyNmY2OGEzMzYwYzE4NDg2ODg4YTpyb2xlPXB1Ymxpc2hlciZzZXNzaW9uX2lkPTFfTVg0ME5Ea3lPVFUyTW41LVUzVnVJRUYxWnlBeE1DQXhPRG96TXpvMU55QlFSRlFnTWpBeE5INHdMalF4TnpBMU1qQXpmbjQmY3JlYXRlX3RpbWU9MTQwNzcyMDg1NiZub25jZT0wLjM3OTM1MzIxNjUzMzI1ODgmZXhwaXJlX3RpbWU9MTQxMDMxMjgyMw==";


	var publisher;


	// Initialize session, set up event listeners, and connect
	var session = OT.initSession(apiKey, sessionId);

	//session.on("streamCreated", function(event) {
	//session.subscribe(vent.stream);
	//});

	session.on('sessionConnected', sessionConnectedHandler);
	session.on('streamCreated', streamCreatedHandler);
	session.connect(token);

	/*function streamCreatedHandler(streamEvent){
	 for(var i=0; i<streams.length; i++){
	 var stream = streamEvent.streams[i];
	 var newDiv = $('<div />', {id: stream.streanId});
	 $('body').append(newDiv);
	 session.subscribe(stream,stream.streanId)
	 }


	 }
	 */

	function sessionConnectedHandler(event){
		publisher = OT.initPublisher("videoContainer", {width:400, height:300});
		session.publish(publisher);
		subscribeToStreams(event.streams);
	}

	function subscribeToStreams(streams){
		for(var i=0; i<streams.length; i++){
			var stream = streams[i];
			if(stream.connection.connectionId!=session.connection.connectionId){
				session.subscribe(stream,"videoContainer");
			}
		}
	}

	function streamCreatedHandler (event) {
		subscribeToStreams(event.streams);
	}

</script>



<div class="adviser-head clearfix">
        <div class="left">
            Video Chat
        </div>
    </div>
	<div class="page_wrapper">
        	<div class="adviser-element padding20 margintop20">
	            <div id="videoContainer"></div>
			</div>   
    </div>
    <div class="clearfix"></div>
