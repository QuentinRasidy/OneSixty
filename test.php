<?php

include ('OneSixtyConnector.php');
include ('Sms.php');
include ('SmsException.php');

$recipients = [];

array_push($recipients,'0485346512');

try{
    //Set the content; the recipients; authenticate and send
    $sms = new Sms;

    $sms->setRecipients($recipients)
    ->setContent('this is a super sms content')
    ->authenticate('td84wOO8F41S7Gxu3eeo8I94K190FQvAeUoDnuegFTuGxkP9SdtUeILUjWyG')
    ->send();
    
}catch(SmsException $e){
      //Treat the exception here
	echo $e->Getmessage();
}

?>
