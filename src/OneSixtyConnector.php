<?php namespace Quentinrasidy\Onesixty;

/*  @author Quentin Rasidy*/
class OneSixtyConnector{

   protected $token ='';
   protected $base_uri = 'https://oneforthy.be/';

    public function authenticate($token){
        $this->token = $token;

        return $this;
    }

    public function createHandler($url){
        echo $this->base_uri . $url;
        $ch = curl_init($this->base_uri . $url);

        curl_setopt($ch,CURLOPT_HTTPHEADER,array (
            "Accept: application/json",
            "Content-Type: application/json",
            'Authorization: Bearer '.$this->token
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        
        //ONLY ON LOCAL
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        return $ch;
    }
}