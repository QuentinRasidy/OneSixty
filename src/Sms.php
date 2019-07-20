<?php namespace Quentinrasidy\Onesixty;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Quentin Rasidy
*/
class Sms extends OneSixtyConnector{

   private $content = '';
   private $recipients = [];
   private $toBeSentDate = '';

    public function setDate($toBeSentDate){
        $this->toBeSentDate = $toBeSentDate;

        return $this;
    }   
    
   public function setContent($content){
        $this->content = $content;

        return $this;
   }
   public function setRecipients($recipients){
        if(is_array($recipients)){
            foreach ($recipients as $recipient) {
                if(!is_array($recipient) || !array_key_exists('phone',$recipient) || !array_key_exists('name',$recipient))
                {
                    throw new SmsException('You did not provide a correct array. Please see documentation');        
                }

                if(!preg_match('/^(?:(?:\+|00)32|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $recipient['phone'])){
                    throw new SmsException('At least one of the recipient is not a valid Belgian number');        
                }

                if(!preg_match('/^(?=.{1,40}$)[a-zA-Z ç é è ô \- 0-9]+(?:[-\'\s][a-zA-Z ç é è ô \- 0-9]+)*$/', $recipient['name'])){
                    throw new SmsException('You did not provide a correct name, please see documentation');        
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

   public function getStatus($id){
        if(!is_numeric($id)){
            throw new SmsException('Expecting an id');
        }
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->base_uri,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        try{
            $response = $client->request('GET','api/sms/'.$id,[
                'auth' => [$this->username, $this->password],
                'headers' => [
                    'Accept'     => 'application/json'
                ],
                'verify' => false
            ]);

            //var_dump(json_decode($response->getBody()));

            $response = json_decode($response->getBody(),true);
            return $response['data']['status'];
            //return $this;
        }catch(ClientException $e){
            throw new SmsException($e->getMessage());
        }
   }

   public function send(){
    //Publish the sms to the onesixty API
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => $this->base_uri,
        // You can set any number of default request options.
        'timeout'  => 2.0,
        ]);
        try{
            $r = $client->request('POST', 'api/sendsms', [
                'json' => [
                    'content' => $this->content,
                    'recipients' => $this->recipients
                ],
                'auth' => [$this->username, $this->password],
                'headers' => [
                    'Accept'     => 'application/json'
                ],
                'verify' => false
            ]);

            if($r->getStatusCode() != 200){
                throw new SmsException($r->getBody());
            }
            else{
                return true;
            }
        }catch(ClientException $e){
            throw new SmsException($e->getMessage());
        }
   }

}