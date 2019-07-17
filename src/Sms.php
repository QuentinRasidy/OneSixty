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

   public function setToBeSentDate($date){
       $this->toBeSentDate = $date;
   }
   public function setRecipients($recipients){
        //Expecting an array here
        $this->recipients = $recipients;
        return $this;
   }

   public function getRecipients(){
       return $this->recipients;
   }

   public function getStatus(){
        return $this;
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
                'auth' => ['@gmail.com', ''],
                'headers' => [
                    'Accept'     => 'application/json'
                ],
                'verify' => false
            ]);

            return true;
        }catch(ClientException $e){
            throw new SmsException($e->getMessage());
        }
   }


    public function schedule(){

    }

}