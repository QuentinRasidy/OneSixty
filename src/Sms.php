<?php namespace Quentinrasidy\Onesixty;

class Sms extends OneSixtyConnector{

   private $content = '';
   private $recipients = [];

   public function setContent($content){
        if(strlen($content) < 10)
            throw new SmsException('You need at least 10 characters');        

        $this->content = $content;
        return $this;
   }
   public function setRecipients($recipients){
        if(is_array($recipients)){
            foreach ($recipients as $recipient) {
                if(!preg_match('/^(?:(?:\+|00)32|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $recipient)){
                    throw new SmsException('At least one of the recipient is not a valid Belgian number');        
                }
            }
            $this->recipients = $recipients;
            return $this;
        }else{
            throw new SmsException('You should provide an array of recipients');
        }
   }

   public function getRecipients(){
       return $this->recipients;
   }
   public function get($id){
    //Publish the sms to the onesixty API
    $ch = $this->createHandler('api/v1/sms/'.$id);

    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($httpcode == 200)
        return true;
    else
        throw new SmsException($output);
   }

   public function send(){
    $ch = $this->createHandler('api/v1/sms');

    $data = array(
        'recipients' => $this->recipients,
        'content' => $this->content
    );

    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
    //curl_setopt($ch, CURLOPT_VERBOSE, true);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    //var_dump($output);
    if($httpcode == 200)
        return json_decode($output,true);
    else
        throw new SmsException($output);
   }

}