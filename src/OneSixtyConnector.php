<?php namespace Quentinrasidy\Onesixty;

use GuzzleHttp\Client;
/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Quentin Rasidy
*/
class OneSixtyConnector{

   /**  @var string $m_SampleProperty define here what this variable is for, do this for every instance variable */
   private $username ='';
   private $password = '';
   protected $base_uri = 'https://api.test/';

    public function authenticate($username, $password){
        $this->username = $username;
        $this->password = $password;

        return $this;
    }
}