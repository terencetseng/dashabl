<?php
 
    // include the PHP TwilioRest library
    require "includes/twilio/twilio.php";
 
    // twilio REST API version
    $ApiVersion = "2010-04-01";

	// twilio Sandbox phone number
	$SandboxNumber = "415-599-2671";
 
    // set our AccountSid and AuthToken
    $AccountSid = "ACec200e242a8bf769a57d35d5707b55ea";
    $AuthToken = "1e84e5c97d63424c236e44bad9ab7ceb";
     
    // instantiate a new Twilio Rest Client
    $client = new TwilioRestClient($AccountSid, $AuthToken);
 
    // make an associative array of people we know, indexed by phone number
    $people = array(
        "+14082091240"=>"Terence Tseng"
    );
         
    // iterate over all our friends
	//if($_POST["Body"] == "test"){
	    foreach ($people as $number => $name) {
 
	        // Send a new outgoinging SMS by POSTing to the SMS resource
	        $response = $client->request("/$ApiVersion/Accounts/$AccountSid/SMS/Messages", 
	            "POST", array(
	            "To" => $number,
	            "From" => $SandboxNumber,
	            "Body" => "Hey $name, Monkey Party at 6PM. Bring Bananas!"
	        ));

	        if($response->IsError)
	            echo "Error: {$response->ErrorMessage}";
	        else
	            echo "Sent message to $name";
	    }
	//}
?>